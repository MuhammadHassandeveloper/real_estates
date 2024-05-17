<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function index() {
        $data = array();
        $data['title'] = 'Agent Dashboard';
        return view('agent.dashboard.index',$data);
    }

    public function properties() {
        $data = array();
        $data['title'] = 'Agent Properties';
        $data['properties'] = Property::get();
        return view('agent.properties.index',$data);
    }

    public function propertyCreate() {
        $data = array();
        $data['title'] = 'Create Property';
        return view('agent.properties.create',$data);
    }
}
