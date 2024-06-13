<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
use App\Models\State;
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
        $data['title'] = 'Property types';
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
        $data['title'] = 'Property types';
        return  view('admin/properties/index',$data);
    }
}
