<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Property;
use App\Models\PropertyCustomerReviews;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyNearbyPlace;
use App\Models\PropertyType;
use App\Models\State;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminPropertyController extends Controller
{

    public function property_types() {
        $data = array();
        $data['types'] = PropertyType::get();
        $data['title'] = 'Property types';
        return  view('admin/property_types/index',$data);
    }
    public function property_types_store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:property_types,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = new  PropertyType();
        $data->name = $request->input('name');
        $save = $data->save();
        if ($save) {
            return back()->with('success', 'Property Type successfully saved.');
        } else {
            return back()->with('error', 'Something went wrong try again.');
        }

    }
    public function property_types_update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('property_types')->ignore($request->id),
            ],]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = PropertyType::findOrFail($request->id);;
        $data->name = $request->input('name');
        $save = $data->save();
        if ($save) {
            return back()->with('success', 'Property Type successfully updated.');
        } else {
            return back()->with('error', 'Something went wrong try again.');
        }

    }
    public function property_types_delete(Request $request) {
        $save =  PropertyType::destroy($request->id);
        if ($save) {
            return back()->with('success', 'Property Type successfully deleted.');
        } else {
            return back()->with('error', 'Something went wrong try again.');
        }

    }


    public function property_features() {
        $data = array();
        $data['features'] = PropertyFeature::get();
        $data['title'] = 'Property Feature';
        return  view('admin/property_features/index',$data);
    }

    public function property_features_store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:property_features,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = new  PropertyFeature();
        $data->name = $request->input('name');
        $save = $data->save();
        if ($save) {
            return back()->with('success', 'Property Feature successfully saved.');
        } else {
            return back()->with('error', 'Something went wrong try again.');
        }

    }
    public function property_features_update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', Rule::unique('property_features')->ignore($request->id),
            ],]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = PropertyFeature::findOrFail($request->id);;
        $data->name = $request->input('name');
        $save = $data->save();
        if ($save) {
            return back()->with('success', 'Property feature successfully updated.');
        } else {
            return back()->with('error', 'Something went wrong try again.');
        }

    }
    public function property_features_delete(Request $request) {
        $save =  PropertyFeature::destroy($request->id);
        if ($save) {
            return back()->with('success', 'Property Type successfully deleted.');
        } else {
            return back()->with('error', 'Something went wrong try again.');
        }

    }


    public function properties() {
        $data = array();
        $data['title'] = 'All Property List';
        $data['properties'] = Property::whereNotIn('status', [4, 5])->get();
        return  view('admin/properties/index',$data);
    }

    public function customerRentalProperties() {
        $data = array();
        $data['title'] = 'Customer Rental Properties';
        $data['properties'] = Property::join('property_rentals', 'properties.id', '=', 'property_rentals.property_id')
            ->select('properties.*','property_rentals.rental_price','property_rentals.start_date',
                'property_rentals.end_date','property_rentals.rental_status','property_rentals.rental_payment_status','property_rentals.rental_days','property_rentals.rental_price','property_rentals.customer_id')
            ->get();

        return  view('admin/properties/rental',$data);
    }

    public function customerPurchasedProperties() {
        $data = array();
        $data['title'] = 'Customer Purchased Properties';
        $data['properties'] = Property::join('property_purchases', 'properties.id', '=', 'property_purchases.property_id')
            ->select('properties.*','property_purchases.purchased_price','property_purchases.purchased_date',
                'property_purchases.purchased_time','property_purchases.purchased_status','property_purchases.purchased_payment_status','property_purchases.customer_id')
            ->get();

        return  view('admin/properties/purchased',$data);
    }

    public function customerFavrouriteProperties() {
        $data = array();
        $data['title'] = 'Customer Favourite Properties';
        $data['properties'] = Property::join('favourite_properties', 'properties.id', '=', 'favourite_properties.property_id')
            ->select('properties.*','favourite_properties.user_id')
            ->get();
        return  view('admin/properties/favourite',$data);
    }

    public function propertyDetail($id)
    {
        $data = array();
        $data['ptype'] = PropertyType::find($id);
        $data['ftypes'] = PropertyFeature::get();
        $data['property'] = Property::find($id);
        $data['pimages'] = PropertyImage::where('property_id', $id)->get();
        $data['nearplaces'] = PropertyNearbyPlace::where('property_id', $id)->get();
        $data['reviews'] = PropertyCustomerReviews::where('property_id', $id)->get();
        $data['title'] = 'Property Details';
        return view('admin.properties.detail', $data);
    }


    public function setReview(Request $request) {
        $data = PropertyCustomerReviews::find($request->id);
        $data->display = $request->display;
        if ($data->save()) {
            return redirect()->back()->with('success', 'Review Status successfully updated');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


}
