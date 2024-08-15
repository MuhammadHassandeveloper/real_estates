<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\FavoriteProperty;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class CustomerPropertyController extends Controller
{
    public function favProperties()
    {
        $data = array();
        $data['title'] = 'Customer Properties';
        $data['properties'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->where('favourite_properties.user_id', Sentinel::getUser()->id)
            ->select('properties.*','favourite_properties.user_id')
            ->get();
        return view('customer.properties.favourite', $data);
    }

    public function purchasedProperties()
    {
        $data = array();
        $data['title'] = 'Purchased Properties';
        $data['properties'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->where('property_purchases.customer_id', Sentinel::getUser()->id)
            ->select('properties.*','property_purchases.purchased_price','property_purchases.purchased_date',
                'property_purchases.purchased_time','property_purchases.purchased_status','property_purchases.purchased_payment_status')
            ->get();
        return view('customer.properties.purchased', $data);
    }

    public function rentalProperties()
    {
        $data = array();
        $data['title'] = 'Rental Properties';
        $data['properties'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->where('property_rentals.customer_id', Sentinel::getUser()->id)
            ->select('properties.*','property_rentals.rental_price','property_rentals.start_date',
                'property_rentals.end_date','property_rentals.rental_status','property_rentals.rental_payment_status','property_rentals.rental_days','property_rentals.rental_price')
            ->get();
        return view('customer.properties.rent', $data);
    }





    public function propertyDetail($id)
    {
        $data = array();
        $data['ptype'] = PropertyType::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['property'] = Property::find($id);
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['title'] = 'Property Details';
        return view('customer.properties.detail', $data);
    }


    public function propertyDelete(Request $request) {
        $pid = $request->property_id;
       $delete = FavoriteProperty::where('property_id', $pid)->where('user_id',Sentinel::getUser()->id)->delete();
       if($delete) {
           return redirect()->back()->with('success','Success deleting property');
       } else {
           return redirect()->back()->with('error','Error deleting property');
       }

    }
}
