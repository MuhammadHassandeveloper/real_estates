<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index() {
        $data = array();
        $data['title'] = 'admin';
        return view('admin.dashboard.index',$data);
    }
}
