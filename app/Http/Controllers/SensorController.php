<?php

namespace App\Http\Controllers;

use App\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    /**
     * SensorController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function index()
    {
        return Sensor::get()->toArray();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
       $sensor =  Sensor::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor with id ' . $id . ' cannot be found.'
            ], 400);
        }

        return $sensor;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_id' => 'required|integer',
            'description' => 'required',
        ]);

        $sensor =  new Sensor();

        $sensor->company_id = $request->company_id;
        $sensor->description = $request->description;

        if ($sensor->save())
            return response()->json([
                'success' => true,
                'sensor' => $sensor
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor could not be added.'
            ], 500);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
       $sensor =  Sensor::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $updated = $sensor->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor could not be updated.'
            ], 500);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $sensor =  Sensor::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor with id ' . $id . ' cannot be found.'
            ], 400);
        }

        if ($sensor->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sensor could not be deleted.'
            ], 500);
        }
    }
}
