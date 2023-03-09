<?php

namespace App\Http\Controllers\BrandLocation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandLocation;
use App\Http\Resources\BrandLocationResource;
use App\Traits\ApiResponser;
use App\Http\Requests\BrandLocation\BrandLocationRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class BrandLocationController extends Controller
{
    use ApiResponser;

    public function listBrandLocation($id)
    {

           $data = DB::table('brand_locations as l')
            ->select(
                'l.id',
                'l.brand_id',
                'l.location_id',
                'b.name as brand_name',
                's.name as location_name',
                'l.created_at'
            )
            ->join('brands as b', 'l.brand_id', 'b.id')
            ->leftjoin('locations as s', 'l.location_id', 's.id')
            //->where('b.store_id', $id)
            ->where('l.location_id', $id)
            ->get();

           /* $data = BrandLocation::with(['brands' => function($query) use ($id) {
                $query->where('store_id', $id);
                },'locations'])
                ->filter()
                ->sort()
                ->getOrPaginate();

                //dd($data);

            /*    $data = BrandLocation::with(['brands'])
                    //->where('brands.store_id', $id)
                    ->filter()
                    ->sort()
                    ->getOrPaginate();
                */
            return $this->successResponse(
                __("Brands - Locations"),
                $data
                //BrandLocationResource::collection($data)
                );
    }


    public function storeBrandLocation(BrandLocationRequest  $request)
    {
        $brand = BrandLocation::create($request->all());
        return $this->successResponse(
            __("New registration created successfully"),
            [
                BrandLocationResource::make($brand)
            ]);
    }

    public function test(Request $request)
    {
        return $this->successResponse(
            __("New registration created successfully"),
            [
                'Test'
            ]);
    }


    public function destroyBrandLocation($id)
    {
        if($id)
        {
            try {
                $brand = BrandLocation ::findOrFail($id);

                $brand->delete();
                return $this->successResponse(
                    __("Brand Location Deleted successfully!"),

                    );
            } catch (\Exception $e) {
                return $this->errorResponse('El id de la marca y concesionario no existe',null,404);
            }
        } else {
            return $this->errorResponse('El id de la marca y concesionario es requerido',null,404);
        }
    }
}
