<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Agent Dashboard';
        $data['properties'] = Property::where('agent_id', Sentinel::getUser()->id)->latest()->limit(8)->get();
        return view('agent.dashboard.index', $data);
    }

    public function profile()
    {
        $data = array();
        $data['title'] = 'Agent Profile';
        return view('agent.profile', $data);
    }




}
