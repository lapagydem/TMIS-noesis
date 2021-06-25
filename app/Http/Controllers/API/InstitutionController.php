<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstitutionsResource;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $institutions = Institution::all();
        return response(['Institutions' => InstitutionsResource::collection($institutions), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [

            'name' => 'required|max:255',
            'business_desc' => 'required'
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $project = Institution::create($data);

        return response(['institution' => new InstitutionsResource($project), 'message' => 'Created successfully'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param Institution $institution
     * @return Response
     */
    public function show(Institution $institution)
    {
        return response(['institution' => new InstitutionsResource($institution), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Institution $institution
     * @return Response
     */
    public function update(Request $request, Institution $institution)
    {
        $institution->update($request->all());
        return response(['institution' => new InstitutionsResource($institution), 'message' => 'Update successfully'], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Institution $institution
     * @return Response
     */
    public function destroy(Institution $institution)
    {
        $institution->delete();

        return response(['message' => 'Deleted']);
    }
}
