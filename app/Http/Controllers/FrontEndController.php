<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        $data['properties'] = Property::where('is_featured',0)->latest()->limit(15)->get();
        $data['fproperties'] = Property::where('is_featured',1)->latest()->limit(15)->get();
        $data['agencies'] = AppHelper::latestAgencies();
        $data['agents'] = AppHelper::latestAgents();
        $data['fproperty'] = AppHelper::SingleFeaturedProperty();
        return view('frontend.index',$data);
    }

    public function properties(Request $request) {
        $properties = Property::query();
        if ($request->input('property_category')) {
            $properties->where('property_category', $request->property_category);
        }
        if ($request->input('min_price')) {
            $properties->where('price', '>=', $request->min_price);
        }
        if ($request->input('max_price')) {
            $properties->where('price', '<=', $request->max_price);
        }

        if ($request->input('bathrooms')) {
            $properties->where('bathrooms', $request->bathrooms);
        }

        if ($request->input('bedrooms')) {
            $properties->where('bedrooms', $request->bedrooms);
        }

        if ($request->filled('city')) {
            $properties->where('city',$request->city);
        }

        $data = [];
        $data['title'] = 'Properties';
        $data['properties'] = $properties->paginate(12);
        $data['fproperties'] = Property::get();
        return view('frontend.properties',$data);
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







}
