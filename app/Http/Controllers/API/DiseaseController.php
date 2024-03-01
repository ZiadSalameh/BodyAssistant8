<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\diseases;
//use Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\diseases as diseasesResource;
use App\Http\Controllers\API\BaseController as BaseController;

class DiseaseController extends Controller
{

    protected function sendResponse($data, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diseases  = diseases::all();
        return $this->sendResponse(diseasesResource::collection($diseases));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'joint_pain' => 'required|boolean',
            'back_pain' => 'required|boolean',
            'neck_pain' => 'required|boolean',
            'rheumatism' => 'required|boolean',
            'nerve_disease' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $diseases = diseases::create($input);
        return $this->sendResponse(new diseasesResource($diseases), 'created successflly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diseases = diseases::find($id);
        if (is_null($diseases)) {
            return $this->sendError('exercise not found');
        }
        return $this->sendResponse(new diseasesResource($diseases), ' diseases created successflly');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, diseases $diseases)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'joint_pain' => 'required|boolean',
            'back_pain' => 'required|boolean',
            'neck_pain' => 'required|boolean',
            'rheumatism' => 'required|boolean',
            'nerve_disease' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $diseases->user_id = $input['user_id'];
        $diseases->joint_pain = $input['joint_pain'];
        $diseases->back_pain = $input['back_pain'];
        $diseases->neck_pain = $input['neck_pain'];
        $diseases->rheumatism = $input['rheumatism'];
        $diseases->nerve_disease = $input['nerve_disease'];

        return $this->sendResponse(new diseasesResource($diseases), 'updated successflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(diseases $diseases)
    {
        $diseases->delete();
        return $this->sendResponse(new diseasesResource($diseases), 'deleted successflly');
    }
}
