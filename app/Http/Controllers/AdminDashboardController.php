<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\City;
use App\Models\Property;
use App\Models\SiteData;
use App\Models\User;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    public function index() {
        $data = array();
        $data['title'] = 'Admin Dashboard';

        $data['propertiesCount'] = Property::count();

        $data['rentedPropertiesCount'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->count();

        $data['purchasedPropertiesCount'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->count();

        $data['rentalSum'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('property_rentals.rental_payment_status', 5)
            ->sum('property_rentals.rental_price');

        $data['purchaseSum'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('property_purchases.purchased_payment_status', 1)
            ->sum('property_purchases.purchased_price');

        $data['favoritePropertiesCount'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->count();

        $now = Carbon::now();
        $data['properties'] = Property::latest()->limit(5)->get();

        //agents
        $data['agents'] = User::whereHas('roles', function($query) {
            $query->where('roles.slug', 'agent');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->whereNotNull('city_id')
            ->whereNotNull('state_id')
            ->latest()
            ->with(['city', 'state', 'country'])
            ->latest()->limit(5)->get();



        $data['monthlyPurchaseSums'] = [];
        for ($month = 1; $month <= 12; $month++) {
            $startOfMonth = Carbon::create($now->year, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($now->year, $month, 1)->endOfMonth();

            $monthlySum = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
                ->where('property_purchases.purchased_payment_status', 1)
                ->whereBetween('property_purchases.created_at', [$startOfMonth, $endOfMonth])
                ->sum('property_purchases.purchased_price');

            $data['monthlyPurchaseSums'][] = $monthlySum;
        }

        return view('admin.dashboard.index',$data);
    }

    public function create()
    {
        $siteSetting = SiteData::first();
        return view('site_settings.create', compact('SiteData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'owner_name' => 'nullable|string',
            'site_title' => 'nullable|string',
            'currency_sign' => 'nullable|string',
            'currency_code' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            'stripe_public_key' => 'nullable|string',
            'stripe_secret_key' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'contact_city' => 'nullable|string',
            'contact_state' => 'nullable|string',
            'contact_zip' => 'nullable|string',
            'contact_country' => 'nullable|string',
            'additional_data' => 'nullable|json',
        ]);

        $data = $request->except(['site_logo', 'favicon']);

        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $request->file('site_logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }

        // Create or update the site settings
        $siteSetting = SiteData::first();
        if ($siteSetting) {
            $siteSetting->update($data);
        } else {
            SiteData::create($data);
        }

        return redirect()->back()->with('success', 'Site settings saved successfully!');
    }

    public function profile()
    {
        $data = array();
        $data['title'] = 'Customer Profile';
        $data['states'] = AppHelper::states();
        $data['cities'] = City::where('state_id',Sentinel::getUser()->state_id)->get();
        return view('admin.profile', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = Sentinel::getUser();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->whatsapp_phone = $request->input('whatsapp_phone');
        $user->country_id = AppHelper::state($request->state_id)->country_id;
        $user->city_id = $request->input('city_id');
        $user->state_id = $request->input('state_id');
        $user->zip_code = $request->input('zip_code');
        $user->bio = $request->input('bio');

        if(isset($request->photo)) {
            $file = $request->photo;
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }
        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Sentinel::getUser();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();
        return redirect()->back()->with('success', 'Password updated successfully.');
    }


}
