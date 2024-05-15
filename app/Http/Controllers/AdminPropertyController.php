<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPropertyController extends Controller
{
    public function property_types() {
        $data = array();
        $data['title'] = 'Property types';
        return  view('admin/property_types/index',$data);
    }


    public function property_features() {
        $data = array();
        $data['title'] = 'Property types';
        return  view('admin/property_features/index',$data);
    }

    public function properties() {
        $data = array();
        $data['title'] = 'Property types';
        return  view('admin/properties/index',$data);
    }
}
