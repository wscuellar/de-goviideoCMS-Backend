<?php

namespace App\Http\Controllers\Api\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BrandResource;
use App\Http\Requests\Brand\BrandRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;

/**
 * @group Maraca por corporación
 */
class BrandController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        //$this->authorize('update', \Auth::user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = Brand::included()
                ->name()
                ->filter()
                ->sort()
                ->getOrPaginate();

            return $this->successResponse(
                __("Marcas"),
                BrandResource::collection($data)
                );
    }

    public function listBrand($id)
    {
            $data = Brand::where('store_id',$id)
                ->name()
                ->filter()
                ->sort()
                ->getOrPaginate();

            return $this->successResponse(
                __("Corporation or stores"),
                BrandResource::collection($data)
                );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $brand = Brand::create($request->except(['image']));

        if($request->file('image')){
            $file_path =  'public/brand';
            $path = $request->file('image')->store($file_path);
            $brand->image =  str_replace('public/','', $path);
            $brand->update();
        }

        return $this->successResponse(
            __("New registration created successfully"),
            [
                BrandResource::make($brand)
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return $this->successResponse(
            __("Brand"),
                BrandResource::make($brand)
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $brand->update(($request->except(['image'])));
        if($request->file('image')){
            Storage::delete(['public/'.$brand->image]);
            $file_path =  'public/brand';
            $path = $request->file('image')->store($file_path);
            $brand->image =  str_replace('public/','', $path);
            $brand->update();
        }
        return $this->successResponse(
            __("Update Brand"),
                BrandResource::make($brand)
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function updateBrand(BrandUpdateRequest $request, $id)
    {
        $brand = Brand::find($id);

        if($brand) {
            $brand->update(($request->except(['image'])));
            if($request->file('image')){
                if($brand->image) {
                    Storage::delete([$brand->image]);
                }
                $file_path =  'public/brand';
                $path = $request->file('image')->store($file_path);
                $brand->image = str_replace('public/','', $path);
                $brand->update();
            }
            return $this->successResponse(
                __("Update Brand"),
                    BrandResource::make($brand)
                );
        } else {
            return $this->errorResponse('El id de la marca no existe',null,404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if($brand) {
            $brand->delete();
            return $this->successResponse(
                __("Brand Deleted successfully!"),

                );
        } else {
            return $this->errorResponse('El id de la marca no existe',null,404);
        }

    }
}
