<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\recommended_meals;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\recommended_meals as recommended_mealsResource;
use App\Http\Controllers\API\BaseController as BaseController;


class recommendedmealsController extends Controller
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
        $recommended_meals  = recommended_meals::all();
        return $this->sendResponse(recommended_mealsResource::collection($recommended_meals));
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
            'meal_id' => 'required|exists:meals,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $recommended_meals = recommended_meals::create($input);
        return $this->sendResponse(new recommended_mealsResource($recommended_meals), 'created successflly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recommended_meals = recommended_meals::find($id);
        if (is_null($recommended_meals)) {
            return $this->sendError('recommended_meals not found');
        }
        return $this->sendResponse(new recommended_mealsResource($recommended_meals), 'recommended_meals found  successflly');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recommended_meals $recommended_meals)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'user_id' => 'required',
            'meal_id' => 'required|exists:meals,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $recommended_meals->user_id = $input['user_id'];
        $recommended_meals->meal_id = $input['meal_id'];
        return $this->sendResponse(new recommended_mealsResource($recommended_meals), 'created successflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(recommended_meals $recommended_meals)
    {
        $recommended_meals->delete();
        return $this->sendResponse(new recommended_mealsResource($recommended_meals), 'deleted successflly');
    }
}
