<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontEndController extends Controller
{
    public function index() {
        $data = [];
        $data['title'] = 'Home';
        return view('frontend.index',$data);
    }







}
