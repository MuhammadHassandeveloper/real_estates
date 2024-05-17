<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Agent Dashboard';
        return view('agent.dashboard.index', $data);
    }

    public function properties()
    {
        $data = array();
        $data['title'] = 'Agent Properties';
        $data['properties'] = Property::get();
        return view('agent.properties.index', $data);
    }

    public function propertyCreate()
    {
        $data = array();
        $data['ptypes'] = PropertyType::get();
        $data['ftypes'] = PropertyFeature::get();
        $data['title'] = 'Create Property';
        return view('agent.properties.create', $data);
    }

    public function propertyStore(Request $request)
    {
        dd($request->all());
    }


}
