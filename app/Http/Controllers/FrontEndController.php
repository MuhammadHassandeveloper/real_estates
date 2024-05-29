<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        return view('frontend.index',$data);
    }

    public function properties(Request $request) {
        $properties = Property::query();
        if ($request->filled('min_price')) {
            $properties->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $properties->where('price', '<=', $request->max_price);
        }
        if ($request->filled('bedrooms')) {
            $properties->where('bedrooms', $request->bedrooms);
        }
        if ($request->filled('bathrooms')) {
            $properties->where('bathrooms', $request->bathrooms);
        }
        if ($request->filled('property_category')) {
            $properties->where('property_category', $request->property_category);
        }

        $data = [];
        $data['title'] = 'Properties';
        $data['properties'] = $properties->paginate(10);
        return view('frontend.properties',$data);
    }

    public function agencies() {
        $data = [];
        $data['title'] = 'Agencies';
        $data['agencies'] = User::join('role_users as r', 'users.id', '=', 'r.user_id')
            ->join('roles as ro', 'r.role_id', '=', 'ro.id')
            ->where('ro.slug', 'agency')
            ->latest()->paginate(12);
        return view('frontend.agencies',$data);
    }

    public function agents() {
        $data = [];
        $data['title'] = 'Agents';
        $data['agents'] = User::join('role_users as r', 'users.id', '=', 'r.user_id')
            ->join('roles as ro', 'r.role_id', '=', 'ro.id')
            ->where('ro.slug', 'agent')
            ->latest()->paginate(12);
        return view('frontend.agents',$data);
    }







}
