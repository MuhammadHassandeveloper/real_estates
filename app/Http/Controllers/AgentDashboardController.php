<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\ActivityReport;
use App\Models\City;
use App\Models\FavoriteProperty;
use App\Models\Property;
use App\Models\PropertyPurchase;
use App\Models\PropertyRental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $data = array();

        $userId = Sentinel::getUser()->id;
        $data['title'] = 'Agent Dashboard';

        $data['propertiesCount'] = Property::where('agent_id', $userId)->count();

        $data['rentedPropertiesCount'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('properties.agent_id', $userId)
            ->count();

        $data['purchasedPropertiesCount'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('properties.agent_id', $userId)
            ->count();

        $data['rentalSum'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_rentals.rental_payment_status', 5)
            ->sum('property_rentals.rental_price');

        $data['purchaseSum'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_purchases.purchased_payment_status', 1)
            ->sum('property_purchases.purchased_price');

        $data['favoritePropertiesCount'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('properties.agent_id', $userId)
            ->count();

        $now = Carbon::now();

        // Weekly sums
        $data['rentalSumWeek'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_rentals.rental_payment_status', 5)
            ->whereBetween('property_rentals.created_at', [$now->startOfWeek(), $now->endOfWeek()])
            ->sum('property_rentals.rental_price');

        $data['purchaseSumWeek'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_purchases.purchased_payment_status', 1)
            ->whereBetween('property_purchases.created_at', [$now->startOfWeek(), $now->endOfWeek()])
            ->sum('property_purchases.purchased_price');

        // Monthly sums
        $data['rentalSumMonth'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_rentals.rental_payment_status', 5)
            ->whereBetween('property_rentals.created_at', [$now->startOfMonth(), $now->endOfMonth()])
            ->sum('property_rentals.rental_price');

        $data['purchaseSumMonth'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_purchases.purchased_payment_status', 1)
            ->whereBetween('property_purchases.created_at', [$now->startOfMonth(), $now->endOfMonth()])
            ->sum('property_purchases.purchased_price');

        // Yearly sums
        $data['rentalSumYear'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_rentals.rental_payment_status', 5)
            ->whereBetween('property_rentals.created_at', [$now->startOfYear(), $now->endOfYear()])
            ->sum('property_rentals.rental_price');

        $data['purchaseSumYear'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('properties.agent_id', $userId)
            ->where('property_purchases.purchased_payment_status', 1)
            ->whereBetween('property_purchases.created_at', [$now->startOfYear(), $now->endOfYear()])
            ->sum('property_purchases.purchased_price');


        return view('agent.dashboard.index', $data);
    }

    public function profile()
    {
        $data = array();
        $data['title'] = 'Agent Profile';
        $data['states'] = AppHelper::states();
        $data['cities'] = City::where('state_id',Sentinel::getUser()->state_id)->get();
        return view('agent.profile', $data);
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
        AppHelper::storeActivity('Profile Update','Update by','success',Sentinel::getUser()->id,1,Sentinel::getUser()->id,'Agent');
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

        AppHelper::storeActivity('Password Update','Update by','success',Sentinel::getUser()->id,1,Sentinel::getUser()->id,'Agent');
        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function activities() {
        $data = array();
        $data['activities'] = ActivityReport::where('system_id',Sentinel::getUser()->id)->where('type',1)->where('role','Agent')->latest()->get();
        $data['title'] = 'Activity';
        return view('agent.activity_report',$data);

    }
}
