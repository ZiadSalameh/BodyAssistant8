<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\meals;
//use Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\meals as mealsResource;
use App\Http\Controllers\API\BaseController as BaseController;

class mealsController extends Controller
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
        $meals  = meals::all();
        return $this->sendResponse(mealsResource::collection($meals));
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
            'name' => 'required',
            'calories' => 'required',
            'protein' => 'required',
            'carbohydrates' => 'required',
            'fat' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $meals = meals::create($input);
        return $this->sendResponse(new mealsResource($meals), 'created successflly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meals = meals::find($id);
        if (is_null($meals)) {
            return $this->sendError('meals not found');
        }
        return $this->sendResponse(new mealsResource($meals), 'meals found  successflly');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, meals $meals)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'calories' => 'required',
            'protein' => 'required',
            'carbohydrates' => 'required',
            'fat' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $meals->name = $input['name'];
        $meals->calories = $input['calories'];
        $meals->protein = $input['protein'];
        $meals->carbohydrates = $input['carbohydrates'];
        $meals->fat = $input['fat'];
        $meals->save();
        return $this->sendResponse(new mealsResource($meals), 'created successflly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(meals $meals)
    {
        $meals->delete();
        return $this->sendResponse(new mealsResource($meals), 'deleted successflly');
    }
}
