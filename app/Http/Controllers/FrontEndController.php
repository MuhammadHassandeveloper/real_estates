<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Mail\AdminPurchaseSuccessMail;
use App\Mail\AgentPurchaseSuccessMail;
use App\Mail\AgentRentalSuccessMail;
use App\Mail\BookingConfirmationMail;
use App\Mail\CustomerMessage;
use App\Mail\UserPurchaseSuccessMail;
use App\Mail\UserRentalSuccessMail;
use App\Models\FavoriteProperty;
use App\Models\Message;
use App\Models\Property;
use App\Models\PropertyCustomerReviews;
use App\Models\PropertyNearbyPlace;
use App\Models\PropertyPurchase;
use App\Models\PropertyRental;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        $data['properties'] = AppHelper::tenNonFeaturedProperties();
        $data['fproperties'] = AppHelper::tenFeaturedProperties();
        $data['agents'] = AppHelper::latestAgents();
        $data['fproperty'] = AppHelper::SingleFeaturedProperty();
        $data['cities'] = AppHelper::cities();
        $data['cityProperties'] = AppHelper::cityProperties();
        return view('frontend.index',$data);
    }

    public function properties(Request $request) {
        // Initialize the properties query
        $properties = Property::query();

        // Filter by property category if provided
        if ($request->input('property_category')) {
            $properties->where('property_category', $request->property_category);
        }

        // Filter by minimum price if provided
        if ($request->input('min_price')) {
            $properties->where('price', '>=', $request->min_price);
        }

        // Filter by maximum price if provided
        if ($request->input('max_price')) {
            $properties->where('price', '<=', $request->max_price);
        }

        // Filter by number of bedrooms if provided
        if ($request->input('bedrooms')) {
            $properties->where('bedrooms', $request->bedrooms);
        }

        // Filter by number of bathrooms if provided
        if ($request->input('bathrooms')) {
            $properties->where('bathrooms', $request->bathrooms);
        }

        // Filter by city ID if provided
        if ($request->filled('city_id')) {
            $properties->where('city_id', $request->city_id);
        }

        // Ensure properties are in countries with status = 1
        $properties->whereHas('country', function ($query) {
            $query->where('status', 1);
        });
        // Prepare data for the view
        $data = [];
        $data['title'] = 'Properties';
        $data['properties'] = $properties->latest()->paginate(12);
        $data['cities'] = AppHelper::cities();

        // Return the view with data
        return view('frontend.properties', $data);
    }


    public function agents() {
        $data = [];
        $data['title'] = 'Agents';
        $data['agents'] = AppHelper::agents();
        return view('frontend.agents',$data);
    }

    public function agentDetail($id) {
        $data = [];
        $data['title'] = 'Agent';
        $data['agent'] = AppHelper::userDetail($id);
        $data['properties'] = AppHelper::agentProperties($id);
        return view('frontend.agentDetail',$data);
    }



    public function propertyDetail($id) {
        $data = [];
        $data['title'] = 'Property';
        $data['property'] = AppHelper::propertyDetail($id);
        $data['fproperties'] =  AppHelper::RandomFeaturedProperties();
        $data['nearplaces'] = PropertyNearbyPlace::where('property_id', $id)->get()->groupBy('type');
        $data['reviews'] = PropertyCustomerReviews::where('property_id', $id)->where('display',1)->get();
        return view('frontend.property',$data);
    }

    public function getCities($state_id)
    {
        $cities = AppHelper::stateCities($state_id);
        return response()->json($cities);
    }


    public function contactUs() {
        $data = [];
        $data['title'] = 'Contact Us';
        return view('frontend.contact',$data);
    }

    public function aboutUs() {
        $data = [];
        $data['title'] = 'About Us';
        return view('frontend.about',$data);
    }

    public function propertyMakeFav($p_id) {
        try {
            $user = Sentinel::getUser();
            if (!$user) {
                return redirect()->back()->with('error', 'You need to be logged in to favorite a property.');
            }

            // Check if property is already favorited by the user
            $count = FavoriteProperty::where('user_id', $user->id)->where('property_id', $p_id)->count();
            if ($count > 0) {
                return redirect()->back()->with('error', 'You have already added this property to favorites.');
            }

            $FavoriteProperty = new FavoriteProperty;
            $FavoriteProperty->user_id = $user->id;
            $FavoriteProperty->property_id = $p_id;
            $res = $FavoriteProperty->save();
            if ($res) {
                return redirect()->back()->with('success', 'You have successfully favorited this property.');
            } else {
                return redirect()->back()->with('error', 'Something went wrong. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function propertyCustomerMessage(Request $request)
    {
        $user = Sentinel::getUser();
        $propertyId = $request->property_id;
        $agentId = $request->agent_id;

        $message = Message::create([
            'customer_id' => $user->id,
            'agent_id' => $agentId,
            'property_id' => $propertyId,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'sender_type' => 'customer',
        ]);

        Mail::to($message->agent->email)->send(new CustomerMessage($message));
        Mail::to(AppHelper::adminEmail())->send(new CustomerMessage($message));

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

    public function propertyRent(Request $request)
    {
        $propertyDetail = Property::find($request->property_id);
        $propertyRental = new PropertyRental();
        $propertyRental->agent_id = $request->agent_id;
        $propertyRental->customer_id = Sentinel::getUser()->id;
        $propertyRental->property_id = $request->property_id;
        $propertyRental->rental_price = str_replace('$', '', $request->calculated_price); // Remove $ symbol from price
        $propertyRental->rental_days = $request->rental_duration_days;
        $propertyRental->note = $request->note;
        $startDate = Carbon::now();
        $propertyRental->start_date = $startDate;
        $propertyRental->end_date = $startDate->copy()->addDays($request->rental_duration_days);
        $propertyRental->rental_status = 0;
        $propertyRental->rental_payment_status = 0;
        $propertyRental->save();

        $propertyDetail->status = 4;
        $propertyDetail->save();

        $app_name = AppHelper::site_name();
        $appCurrenycode = $propertyDetail->country->currency;
        $stripeSecretKey = AppHelper::stripe_secret_key();
        Stripe::setApiKey($stripeSecretKey);
        $mode = 'payment';
        $pay_price = str_replace('$', '', $request->calculated_price);
        if ($pay_price > 0) {
            if ($pay_price > 999999.99) {
                return redirect()->back()->with('error', 'The total amount due exceeds the maximum allowed limit.');
            }

            $line_items = [
                [
                    'price_data' => [
                        'currency' => $appCurrenycode,
                        'product_data' => [
                            'name' => $app_name,
                            'description' => $propertyDetail->title,
                        ],
                        'unit_amount' => $pay_price * 100,
                    ],
                    'quantity' => 1,
                ]
            ];
            $metadata = ['rental_property_id' => $propertyRental->id, 'agent_id' => $request->agent_id];
            $session = Session::create([
                'payment_method_types' => ['card'],
                'success_url' => url('/property_stripe_success?rental_property_id=' . $propertyRental->id . '&session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/property_stripe_cancel'),
                'mode' => $mode,
                'line_items' => $line_items,
                'metadata' => $metadata
            ]);
            return redirect($session->url);
        }
        return redirect()->back()->with('success', 'Property rented successfully without payment');
    }

// Stripe success and cancel functions
    public function stripe_success(Request $request)
    {
        $session_id = $request->session_id;
        $rental_property_id = $request->rental_property_id;
        // Stripe keys and payment details
        $stripeSecretKey = AppHelper::stripe_secret_key();
        Stripe::setApiKey($stripeSecretKey);
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
        $charge_id = $paymentIntent->latest_charge;
        $data = array();
        if ($charge_id) {
            $data['payment_stripe_id'] = $charge_id;
            $data['rental_payment_status'] = 1;
            $data['rental_status'] = 1;
            PropertyRental::where('id', $rental_property_id)->update($data);

            $propertyRental = PropertyRental::with(['customer', 'property', 'agent'])->find($rental_property_id);
            $property = Property::find($propertyRental->property_id);
            $property->status = 5;
            $property->save();

            // Send emails to user and agent
            Mail::to($propertyRental->customer->email)->send(new UserRentalSuccessMail($propertyRental));
            Mail::to($propertyRental->agent->email)->send(new AgentRentalSuccessMail($propertyRental));
            Mail::to(AppHelper::adminEmail())->send(new AgentRentalSuccessMail($propertyRental));

            return redirect()->to('/properties')->with('success', 'You have successfully rented this property and i have sent you email confirmation');
        } else {
            return redirect()->to('/properties')->with('error', 'Something went wrong please try again later');
        }
    }


    //property purchased section
    public function propertyPurchased($id) {
        $propertyDetail = Property::find($id);

        if(!$propertyDetail) {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }

        $agent_id = $propertyDetail->agent_id;
        $pay_price = $propertyDetail->price;
        $customer_id = Sentinel::getUser()->id;
        $date = Carbon::now();
        $time = $date->format('H:i:s');

        // Create a new PropertyPurchase record
        $ppurchased = new PropertyPurchase();
        $ppurchased->agent_id = $agent_id;
        $ppurchased->customer_id = $customer_id;
        $ppurchased->property_id = $id;
        $ppurchased->purchased_date = $date;
        $ppurchased->purchased_time = $time;
        $ppurchased->purchased_status = 0;
        $ppurchased->purchased_payment_status = 0;
        $ppurchased->purchased_price = $pay_price;
        $ppurchased->save();

        // Update property status
        $propertyDetail->status = 4; // Assuming 4 means 'in process' or 'pending payment'
        $propertyDetail->save();

        // Stripe payment processing
        $app_name = AppHelper::site_name();
        $appCurrencyCode = $propertyDetail->country->currency;

        $stripeSecretKey = AppHelper::stripe_secret_key();
        Stripe::setApiKey($stripeSecretKey);
        $mode = 'payment';

        if ($pay_price > 0) {
            if ($pay_price > 999999.99) {
                return redirect()->back()->with('error', 'The total amount due exceeds the maximum allowed limit.');
            }

            $line_items = [
                [
                    'price_data' => [
                        'currency' => $appCurrencyCode,
                        'product_data' => [
                            'name' => $app_name,
                            'description' => $propertyDetail->title,
                        ],
                        'unit_amount' => $pay_price * 100,
                    ],
                    'quantity' => 1,
                ]
            ];

            $metadata = ['purchased_property_id' => $ppurchased->id, 'agent_id' => $agent_id];
            $session = Session::create([
                'payment_method_types' => ['card'],
                'success_url' => url('/purchased_property_stripe_success?purchased_property_id=' . $ppurchased->id . '&session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/property_stripe_cancel'),
                'mode' => $mode,
                'line_items' => $line_items,
                'metadata' => $metadata
            ]);

            return redirect($session->url);
        }
    }

    public function purchased_property_stripe_success(Request $request) {
        $session_id = $request->session_id;
        $purchased_property_id = $request->purchased_property_id;

        // Stripe keys and payment details
        $stripeSecretKey = AppHelper::stripe_secret_key();
        Stripe::setApiKey($stripeSecretKey);
        $session = \Stripe\Checkout\Session::retrieve($session_id);
        $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
        $charge_id = $paymentIntent->latest_charge;
        $data = [];

        if ($charge_id) {
            $data['payment_stripe_id'] = $charge_id;
            $data['purchased_payment_status'] = 1;
            $data['purchased_status'] = 1;
            PropertyPurchase::where('id', $purchased_property_id)->update($data);

            $propertypurchased = PropertyPurchase::with(['customer', 'property', 'agent'])->find($purchased_property_id);
            $property = Property::find($propertypurchased->property_id);
            $property->status = 5; // Assuming 5 means 'purchased'
            $property->save();

            // Send emails to user, agent, and admin
            Mail::to($propertypurchased->customer->email)->send(new UserPurchaseSuccessMail($propertypurchased));
            Mail::to($propertypurchased->agent->email)->send(new AgentPurchaseSuccessMail($propertypurchased));
            Mail::to(AppHelper::adminEmail())->send(new AdminPurchaseSuccessMail($propertypurchased));

            return redirect()->to('/properties')->with('success', 'You have successfully purchased this property, and a confirmation email has been sent to you.');
        } else {
            return redirect()->to('/properties')->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function stripe_cancel(Request $request)
    {
        return redirect()->to('/properties')->with('error', 'Something went wrong please try again later');
    }

    public function propertyCustomerReview(Request $request)
    {
        if (Sentinel::check()) {
            $property = Property::findOrFail($request->pid);
            $userId = Sentinel::getUser()->id;
            $user = Sentinel::getUser();

            if ($user && $user->inRole('customer')) {
                if ($property) {
                    if ($property->property_category == 'Rent') {
                        $rproperty = PropertyRental::where('customer_id', $userId)
                            ->where('property_id',$request->pid)
                            ->whereNotNull('payment_stripe_id')
                            ->where('rental_status', 1)
                            ->where('rental_payment_status', 1)
                            ->first();

                        if ($rproperty) {
                            $review = PropertyCustomerReviews::create([
                                'property_id' => $request->pid,
                                'user_id' => $userId,
                                'name' => $request->name,
                                'email' => $request->email,
                                'subject' => $request->subject,
                                'message' => $request->message,
                            ]);

                            return $review ?
                                redirect()->back()->with('success', 'You have successfully reviewed') :
                                redirect()->back()->with('error', 'Please try again');
                        } else {
                            return redirect()->back()->with('error', 'You may not have rented this property');
                        }
                    } elseif ($property->property_category == 'Sale') {
                        $pproperty = PropertyPurchase::where('customer_id', $userId)
                            ->where('property_id',$request->pid)
                            ->whereNotNull('payment_stripe_id')
                            ->where('purchased_status', 1)
                            ->where('purchased_payment_status', 1)
                            ->first();

                        if ($pproperty) {
                            $review = PropertyCustomerReviews::create([
                                'property_id' => $request->pid,
                                'user_id' => $userId,
                                'name' => $request->name,
                                'email' => $request->email,
                                'subject' => $request->subject,
                                'message' => $request->message,
                            ]);

                            return $review ?
                                redirect()->back()->with('success', 'You have successfully reviewed') :
                                redirect()->back()->with('error', 'Please try again');
                        } else {
                            return redirect()->back()->with('error', 'You may not have purchased this property');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Property category not recognized');
                    }
                } else {
                    return redirect()->back()->with('error', 'Property not found');
                }
            } else {
                return redirect()->back()->with('error', 'User not found or you may not be a customer');
            }
        } else {
            return redirect()->back()->with('error', 'User not found. You need to log in first');
        }
    }



}
