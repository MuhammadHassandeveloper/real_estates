<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Mail\CustomerMessage;
use App\Models\FavoriteProperty;
use App\Models\Message;
use App\Models\Property;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        $data['properties'] = AppHelper::tenNonFeaturedProerties();
        $data['fproperties'] = AppHelper::tenFeaturedProerties();
        $data['agencies'] = AppHelper::latestAgencies();
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
        $properties->whereHas('country', function ($query) {
            $query->where('status', 1);
        });
        $data = [];
        $data['title'] = 'Properties';
        $data['properties'] = $properties->paginate(12);
        $data['cities'] = AppHelper::cities();

        // Return the view with data
        return view('frontend.properties', $data);
    }

    public function agencies() {
        $data = [];
        $data['title'] = 'Agencies';
        $data['agencies'] = AppHelper::agencies();
        return view('frontend.agencies',$data);
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

    public function agencyDetail($id) {
        $data = [];
        $data['title'] = 'Agency';
        $data['agency'] = AppHelper::userDetail($id);
        $data['properties'] = AppHelper::agencyProperties($id);
        $data['agents'] = AppHelper::agencyAgents($id);
        return view('frontend.agencyDetail',$data);
    }


    public function propertyDetail($id) {
        $data = [];
        $data['title'] = 'Property';
        $data['property'] = AppHelper::propertyDetail($id);
        $data['fproperties'] =  AppHelper::RandomFeaturedProperties();
        return view('frontend.property',$data);
    }

    public function getCities($state_id)
    {
        $cities = AppHelper::stateCities($state_id);
        return response()->json($cities);
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
        ]);

        Mail::to($message->agent->email)->send(new CustomerMessage($message));
        Mail::to(AppHelper::adminEmail())->send(new CustomerMessage($message));

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

}
