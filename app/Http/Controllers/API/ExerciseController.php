<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\exercises;
//use Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\exercises as exercisesResource;
use App\Http\Controllers\API\BaseController as BaseController;

class ExerciseController extends Controller
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
        $exercises  = exercises::all();
        return $this->sendResponse(exercisesResource::collection($exercises));
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $exercises = exercises::create($input);
        return $this->sendResponse(new exercisesResource($exercises), 'created successflly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercises = exercises::find($id);
        if (is_null($exercises)) {
            return $this->sendError('exercise not found');
        }
        return $this->sendResponse(new exercisesResource($exercises), 'exercise found  successflly');
    }

    public function update(Request $request, exercises $exercises)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $exercises->name = $input['name'];
        $exercises->description = $input['description'];
        return $this->sendResponse(new exercisesResource($exercises), 'created successflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(exercises $exercises)
    {
        $exercises->delete();
        return $this->sendResponse(new exercisesResource($exercises), 'deleted successflly');
    }
}
