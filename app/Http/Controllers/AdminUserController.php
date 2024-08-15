<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\FavoriteProperty;
use App\Models\Property;
use App\Models\PropertyPurchase;
use App\Models\PropertyRental;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function agents() {
        $data = array();
        $data['agents'] = User::whereHas('roles', function($query) {
            $query->where('slug', 'agent');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('created_at', 'desc')
            ->with(['city', 'state', 'country'])
            ->get();
        $data['title'] = 'Agents list';
        return  view('admin/users/agents',$data);
    }


    public function customers() {
        $data = array();
        $data['agents'] = User::whereHas('roles', function($query) {
            $query->where('slug', 'customer');
        })
            ->whereHas('country', function ($query) {
                $query->where('status', 1);
            })
            ->orderBy('created_at', 'desc')
            ->with(['city', 'state', 'country'])
            ->get();
        $data['title'] = 'Customers list';
        return  view('admin/users/customers',$data);
    }


    public function agentDetail($id)
    {
        $userId = $id;
        $data = array();

        $data['title'] = 'Agent Detail';
        $data['agent'] = User::find($userId);
        $data['properties'] = AppHelper::agentProperties($userId);


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
        return view('admin.users.agent_detail', $data);
    }


    public function customerDetail($id)
    {
        $userId = $id;
        $data = array();
        $data['title'] = 'Customer Detail';
        $data['customer'] = User::find($userId);

        $data['fproperties'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('favourite_properties.user_id', $userId)
            ->select('properties.*','favourite_properties.user_id')
            ->get();

        $data['pproperties'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('property_purchases.customer_id', $userId)
            ->select('properties.*','property_purchases.purchased_price','property_purchases.purchased_date',
                'property_purchases.purchased_time','property_purchases.purchased_status','property_purchases.purchased_payment_status')
            ->get();

        $data['rproperties'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('property_rentals.customer_id', $userId)
            ->select('properties.*','property_rentals.rental_price','property_rentals.start_date',
                'property_rentals.end_date','property_rentals.rental_status','property_rentals.rental_payment_status','property_rentals.rental_days','property_rentals.rental_price')
            ->get();


        $data['favoritePropertiesCount'] = FavoriteProperty::where('user_id',$userId)->count();
        $data['rentedPropertiesCount'] = PropertyRental::where('customer_id', $userId)->count();
        $data['purchasedPropertiesCount'] = PropertyPurchase::where('customer_id', $userId)->count();
        return view('admin.users.customer_detail', $data);
    }


}
