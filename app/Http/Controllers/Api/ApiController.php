<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


    public function StateCites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'state_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $cities = AppHelper::stateCities($request->state_id);
            if ($cities->isNotEmpty()) {
                $data['cities'] = $cities;
                return response()->json([
                    'success' => true,
                    'data' => $data,
                    'msg' => 'State Cities list fetched successfully'
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
