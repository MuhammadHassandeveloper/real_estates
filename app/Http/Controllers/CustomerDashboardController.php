<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\ActivityReport;
use App\Models\City;
use App\Models\Message;
use App\Models\Property;
use App\Models\PropertyPurchase;
use App\Models\PropertyRental;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = Sentinel::getUser()->id;
        $data = array();
        $data['title'] = 'Customer Dashboard';
        $data['favoriteProperties'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('favourite_properties.user_id', $userId)
            ->select('properties.*')
            ->latest()
            ->limit(5)
            ->get();
        $data['favoritePropertiesCount'] = $data['favoriteProperties']->count();
        $data['rentedPropertiesCount'] = PropertyRental::where('customer_id', $userId)->count();
        $data['purchasedPropertiesCount'] = PropertyPurchase::where('customer_id', $userId)->count();
        $data['messages'] = Message::where('customer_id', $userId)->where('sender_type','agent')->latest()->limit(5)->get();
        return view('customer.dashboard.index', $data);
    }


    public function profile()
    {
        $data = array();
        $data['title'] = 'Customer Profile';
        $data['states'] = AppHelper::states();
        $data['cities'] = City::where('state_id',Sentinel::getUser()->state_id)->get();
        return view('customer.profile', $data);
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
        AppHelper::storeActivity('Profile Update','Update by'.' '.Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name,'success',Sentinel::getUser()->id,1,Sentinel::getUser()->id,'Customer');
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

        AppHelper::storeActivity('Password Update','Update by'.Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name ,'success',Sentinel::getUser()->id,1,Sentinel::getUser()->id,'Customer');
        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function activities() {
        $data = array();
        $data['activities'] = ActivityReport::where('system_id',Sentinel::getUser()->id)->where('type',1)->where('role','Customer')->latest()->get();
        $data['title'] = 'Activity';
        return view('customer.activity_report',$data);
    }


}
