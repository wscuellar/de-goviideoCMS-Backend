<?php

namespace App\Http\Controllers\Api\Concessionaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Concessionaire;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ConcessionaireResource;
use App\Http\Requests\Concessionaire\RegisterConcessionaireRequest;
use App\Http\Requests\Concessionaire\UpdateConcessionaireRequest;
class ConcessionaireController extends Controller
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
        $data = Concessionaire::included()
        ->name()
        ->filter()
        ->sort()
        ->getOrPaginate();

        return $this->successResponse(
            __("Concesionarios"),
            ConcessionaireResource::collection($data)
            );
    }


    public function listConcessionaire($id)
    {
            $data = Concessionaire::where('store_id', $id)
                ->name()
                ->filter()
                ->sort()
                ->getOrPaginate();

            return $this->successResponse(
                __("Corporation or stores"),
                ConcessionaireResource::collection($data)
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterConcessionaireRequest $request)
    {
        $concessionaire = Concessionaire::create($request->except(['image']));

        if($request->file('image'))
        {
            $file_path =  'public/concessionaire';
            $path = $request->file('image')->store($file_path);
            $concessionaire->image =  str_replace('public/','', $path);
            $concessionaire->update();
        }

        return $this->successResponse(
            __("New registration created successfully"),
            [
                ConcessionaireResource::make($concessionaire)
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Concessionaire $concessionaire)
    {
        return $this->successResponse(
            __("Concessionaire"),
                ConcessionaireResource::make($concessionaire)
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConcessionaireRequest $request, Concessionaire $concessionaire)
    {
        $concessionaire->update(($request->except(['image'])));
        if($request->file('image')){
            Storage::delete(['public/'.$concessionaire->image]);
            $file_path =  'public/concessionaire';
            $path = $request->file('image')->store($file_path);
            $concessionaire->image =  str_replace('public/','', $path);
            $concessionaire->update();
        }
        return $this->successResponse(
            __("Update concessionaire"),
                ConcessionaireResource::make($concessionaire)
            );
    }

    public function updateConcessionaire(UpdateConcessionaireRequest  $request, $id)
    {
        $concessionaire = Concessionaire::find($id);

        if($concessionaire) {
            $concessionaire->update(($request->except(['image'])));
            if($request->file('image')){
                if($concessionaire->image) {
                    Storage::delete([$concessionaire->image]);
                }
                $file_path =  'public/concessionaire';
                $path = $request->file('image')->store($file_path);
                $concessionaire->image = str_replace('public/','', $path);
                $concessionaire->update();
            }
            return $this->successResponse(
                __("Update Concessionaire"),
                    ConcessionaireResource::make($concessionaire)
                );
        } else {
            return $this->errorResponse('El id del concesionario no existe',null,404);
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concessionaire $concessionaire)
    {
        if($concessionaire)
        {
            $concessionaire->delete();
            return $this->successResponse(
                __("Concessionaire Deleted successfully!"),

                );
        } else {
            return $this->errorResponse('El id del concesionario no existe', null, 404);
        }
    }
}
