<?php

namespace App\Http\Controllers;

use ElfSundae\Laravel\Hashid\Facades\Hashid;
use Illuminate\Http\Request;
use App\Sensor;
use App\APISecurity;

class APISecurityController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function generateReversibleHash(Request $request)
    {
        hashid('hashids_string');
        Hashid::connection('hashids_string');
        $this->validate($request, [
            'sensor_code' => 'required|integer|min:'.Sensor::MIN_SENSOR_ID,
        ]);

        return response()->json([
            'success'   =>  true,
            'sensor_code'       =>  $request->sensor_code,
            'sensor_code_hash'  =>  APISecurity::getReversibleHash($request->sensor_code),
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reverseHash(Request $request)
    {
        $this->validate($request, [
            'sensor_code_hash' => 'required|string',
        ]);

        return response()->json([
            'success'   =>  true,
            'sensor_code'       =>  APISecurity::getReverseHash($request->sensor_code_hash),
            'sensor_code_hash'  => $request->sensor_code_hash,
        ], 200);
    }
}
