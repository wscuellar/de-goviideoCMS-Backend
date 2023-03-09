<?php

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Http\Requests\Location\UpdateLocationRequest;
use App\Http\Requests\Location\RegisterLocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{

    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Location::included()
                ->name()
                ->filter()
                ->sort()
                ->getOrPaginate();

        return $this->successResponse(
                __("Sucursales"),
                LocationResource::collection($data)
                );
    }

        public function listLocation($id)
        {
            $data = Location::where('store_id',$id)
                ->name()
                ->filter()
                ->sort()
                ->getOrPaginate();

            return $this->successResponse(
                __("Locaciones por tienda"),
                LocationResource::collection($data)
                );
        }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterLocationRequest $request)
    {
        $location = Location::create($request->all());

        return $this->successResponse(
            __("New registration created successfully"),
            [
                LocationResource::make($location)
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return $this->successResponse(
            __("Location"),
                LocationResource::make($location)
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update(($request->all()));
        return $this->successResponse(
            __("Update Location"),
                LocationResource::make($location)
            );
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function updateLocation(UpdateLocationRequest $request, $id)
    {
        $location = Location::find($id);
        if($location) {
            $location->update(($request->all()));
            return $this->successResponse(
                __("Update location"),
                    LocationResource::make($location)
                );
        } else {
            return $this->errorResponse('El id de la locación no existe',null,404);
        }

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location) {
            $location->delete();
            return $this->successResponse(
                __("Location Deleted successfully!"),

                );
        } else {
            return $this->errorResponse('El id de la locación no existe', null,404);
        }
    }
}
