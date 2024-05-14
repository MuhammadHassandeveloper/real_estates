<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        return view('frontend.index',$data);
    }

}
