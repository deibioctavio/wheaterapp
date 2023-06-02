<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
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
        return Company::get()->toArray();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $company =  Company::find($id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, company with id ' . $id . ' cannot be found.'
            ], 400);
        }

        return $company;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|integer',
            'description' => 'required',
        ]);

        $company =  new Company();

        $company->name = $request->name;
        $company->description = $request->description;

        if ($company->save())
            return response()->json([
                'success' => true,
                'sensor' => $company
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, company could not be added.'
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
