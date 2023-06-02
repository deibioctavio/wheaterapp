<?php

namespace App\Http\Controllers;

use App\APISecurity;
use App\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    private $defaultRegisterCount;
    private $defaultRegisterOffSet;
    private $defaultRegisterSortOrder;
    private $query;
    /**
     * SensorController constructor.
     */
    public function __construct()
    {
        $this->defaultRegisterCount = 10;
        $this->defaultRegisterOffSet = 0;
        $this->defaultRegisterSortOrder = 'DESC';
        $this->query = null;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return [
            'count' => SensorData::get()->count(),
            'data' =>   SensorData::orderBy('id', $this->defaultRegisterSortOrder)
                            ->limit($this->defaultRegisterCount)->get()
        ];
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ascendantSortOrder = null, $pLimit = null, $pOffset = null)
    {
        $limit = is_null($pLimit)?$this->defaultRegisterCount:$pLimit;
        $offset = is_null($pOffset)?$this->defaultRegisterOffSet:$pOffset;
        $sortOrder = is_null($ascendantSortOrder)||$ascendantSortOrder!=1?$this->defaultRegisterSortOrder:"ASC";

        $sensorData =  SensorData::orderBy('id', $sortOrder)->limit($limit)->offset($offset)->get();

        if (!$sensorData) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, no found.'
            ], 406);
        }

        return $sensorData;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showBySensorId($sensorId, $ascendantSortOrder = null, $pLimit = null, $pOffset = null)
    {
        $sensorId = APISecurity::getReverseHash($sensorId);

        $limit = is_null($pLimit)?$this->defaultRegisterCount:$pLimit;
        $offset = is_null($pOffset)?$this->defaultRegisterOffSet:$pOffset;
        $sortOrder = is_null($ascendantSortOrder)||$ascendantSortOrder!=1?$this->defaultRegisterSortOrder:"ASC";

        $sensorData =  SensorData::where('sensor_id', $sensorId)->orderBy('id', $sortOrder)->limit($limit)
                            ->offset($offset)->get();

        if (!$sensorData) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor data with id ' . $sensorId . ' cannot be found.'
            ], 400);
        }

        return $sensorData;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        \Log::info("DATA: ".print_r($request->all(), true));
        $this->validate($request, [
            'sid' => 'required',
            'tp' => 'required|between:0,99.99',
        ]);

        $sensorData =  new SensorData();

        $sensorData->sensor_id = APISecurity::getReverseHash($request->sid);
        $sensorData->temperature = floatval($request->tp);
        $sensorData->extra_data = $request->extra_data;
        $sensorData->power_ok = $request->pok;

        if ($sensorData->save())
            return response()->json([
                'success' => true,
                'sensor' => $sensorData,
            ], 201);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor data could not be added.'
            ], 500);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sensor_code' => 'required',
            'temperature' => 'required|float',
        ]);
        $sensorData =  SensorData::find($id);

        if (!$sensorData) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor data with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $sensorData->sensor_id = APISecurity::getReverseHash($request->sensor_code);
        $sensorData->temperature = $request->temperature;
        $sensorData->description = $request->sensor_code;

        $updated = $sensorData->save();

        if ($updated) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor data could not be updated.'
            ], 500);
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $sensorData =  SensorData::find($id);

        if (!$sensorData) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, sensor data with id ' . $id . ' cannot be found.'
            ], 400);
        }

        if ($sensorData->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sensor data could not be deleted.'
            ], 500);
        }
    }

    private function getOrderAndLength() {

    }
}
