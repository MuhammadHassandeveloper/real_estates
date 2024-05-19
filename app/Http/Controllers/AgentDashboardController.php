<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use Cartalyst\Sentinel\Sentinel;
use Illuminate\Http\Request;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Agent Dashboard';
        return view('agent.dashboard.index', $data);
    }




}
