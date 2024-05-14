<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getLoginPage() {
        $data = array();
        $data['title'] = 'Admin Login';
        return view('admin.login',$data);
    }
}
