<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Property;
use Illuminate\Http\Request;


class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        $data['properties'] = Property::where('is_featured',0)->latest()->limit(15)->get();
        $data['fproperties'] = Property::where('is_featured',1)->latest()->limit(15)->get();
        $data['agencies'] = Helpers::latestAgencies();
        $data['agents'] = Helpers::latestAgents();
        $data['fproperty'] = Helpers::SingleFeaturedProperty();
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
        $data['agencies'] = Helpers::agencies();
        return view('frontend.agencies',$data);
    }

    public function agents() {
        $data = [];
        $data['title'] = 'Agents';
        $data['agents'] = Helpers::agents();
        return view('frontend.agents',$data);
    }

    public function agent($id) {
        $data = [];
        $data['title'] = 'Agent';
        $data['agent'] = Helpers::userDetail($id);
        $data['properties'] = Helpers::agentProperties($id);
        return view('frontend.agent',$data);
    }

    public function agency($id) {
        $data = [];
        $data['title'] = 'Agency';
        $data['agency'] = Helpers::userDetail($id);
        $data['properties'] = Helpers::agencyProperties($id);
        $data['agents'] = Helpers::agencyAgents($id);
        return view('frontend.agency',$data);
    }


    public function propertyDetail($id) {
        $data = [];
        $data['title'] = 'Property';
        $data['property'] = Helpers::propertyDetail($id);
        return view('frontend.property',$data);
    }







}
