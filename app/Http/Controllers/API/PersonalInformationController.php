<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\personal_inforamtion;
//use Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\personal_inforamtion as personal_inforamtionResource;
use App\Http\Controllers\API\BaseController as BaseController;




class PersonalInformationController extends Controller
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
        $personal_information  = personal_inforamtion::all();
        return $this->sendResponse(personal_inforamtionResource::collection($personal_information));
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
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
            'activity_level' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $personal_inforamtion = personal_inforamtion::create($input);
        return $this->sendResponse(new personal_inforamtionResource($personal_inforamtion), 'created successflly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personal_inforamtion = personal_inforamtion::find($id);
        if (is_null($personal_inforamtion)) {
            return $this->sendError('personal_inforamtion not found');
        }
        return $this->sendResponse(new personal_inforamtionResource($personal_inforamtion), 'personal_inforamtion found  successflly');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  personal_inforamtion $personal_inforamtion)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
            'activity_level' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $personal_inforamtion->user_id = $input['user_id'];
        $personal_inforamtion->age = $input['age'];
        $personal_inforamtion->weight = $input['weight'];
        $personal_inforamtion->height = $input['height'];
        $personal_inforamtion->gender = $input['gender'];
        $personal_inforamtion->activity_level = $input['activity_level'];

        return $this->sendResponse(new personal_inforamtionResource($personal_inforamtion), 'created successflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(personal_inforamtion $personal_inforamtion)
    {
        $personal_inforamtion->delete();
        return $this->sendResponse(new personal_inforamtionResource($personal_inforamtion), 'deleted successflly');
    }
}
