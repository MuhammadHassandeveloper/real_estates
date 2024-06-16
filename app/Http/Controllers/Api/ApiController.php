<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function states()
    {
        try {
            $states = AppHelper::states();
            if ($states->isNotEmpty()) {
                $data['states'] = $states;
                return response()->json([
                    'success' => true,
                    'data' => $data,
                    'msg' => 'States list fetched successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No states data found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch states data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function cities()
    {
        try {
            $cities = AppHelper::cities();
            if ($cities->isNotEmpty()) {
                $data['cities'] = $cities;
                return response()->json([
                    'success' => true,
                    'data' => $data,
                    'msg' => 'Cities list fetched successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No cities data found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch cities data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
