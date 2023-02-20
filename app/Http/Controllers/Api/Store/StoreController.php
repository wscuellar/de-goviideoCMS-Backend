<?php

namespace App\Http\Controllers\Api\Store;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Store;
use App\Models\User;
use  App\Http\Requests\Store\RegisterStoreRequest;
use  App\Http\Requests\Store\StoreUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\StoreResource;
use Illuminate\Support\Facades\Auth;

/**
 * @group Corporation or stores
 */
class StoreController extends Controller
{
    use ApiResponser;

     /**
     * Display a listing of the Store
     *
     * @authenticated
     *
     * @response status=200  {
     *  "status": "Success",
     *  "message": "Store listing",
     *  "data":  [
     *    {
     *       "id": "2c4c5a3b-5289-4b26-9cea-43b955bb1881",
     *       "name": "SEPIIA",
     *       "url": "https://sepiia.com/",
     *       "key": "594f02d3b382bcc05878a10453e5dd82",
     *       "key": "88afd077fe11c20337209c643a21fe7b",
     *
     *       "status": 1,
     *       "created_at": "2022-08-12T03:19:04.000000Z",
     *       "updated_at": "2022-08-12T03:19:04.000000Z"
     *    }
     *   ]
     * }
     *
     *
     * @response status=400 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Store::included()
                ->filter()
                ->sort()
		        ->getOrPaginate();

        return $this->successResponse(
            __("Corporation or stores"),
            StoreResource::collection($data)
            );
    }


    /**
     * Store a newly created resource in storage.
     * @authenticated
     * @param  RegisterStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterStoreRequest $request) : JsonResponse
    {
        $user = auth()->user();
        if($user->type == 'admin')
        {
            $store = Store::create($request->except(['image']));
            $store_id = $store->id;

            if($request->file('image')){
                $file_path =  'public/company/';
                $path = $request->file('image')->store($file_path);
                $store->image =  str_replace('public/','', $path);
                $store->update();
            }

            $user->store_id = $store->id;
            $user->save();

            return $this->successResponse(
                __("New registration created successfully"),
                    StoreResource::make($store)
            );

        } else {
            return $this->errorResponse('El usuario es un administrador, por esta via no puede realizar el registro',null,404);
        }
    }


     /**
     * Display the specified resource.
     *
     * @authenticated
     * @bodyParam id int required The id of the Store. Example: 1
     *
     * @response 200 {
     *  "status": "Success",
     *  "message": "Store listing",
     *  "data": {
     *       "id": "2c4c5a3b-5289-4b26-9cea-43b955bb1881",
     *       "name": "Test Garcia Varona Maderas",
     *       "url": "https://pruebas.garciavarona.com",
     *       "key": "594f02d3b382bcc05878a10453e5dd82",
     *       "store_key": "88afd077fe11c20337209c643a21fe7b",
     *       "store_type_id": 45,
     *       "status": 1,
     *       "created_at": "2022-08-12T03:19:04.000000Z",
     *       "updated_at": "2022-08-12T03:19:04.000000Z"
     *    }
     * }
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {

        return $this->successResponse(
            __("Store"),
                StoreResource::make($store)
            );
    }

     /**
     * Display the specified resource.
     *
     * @authenticated
     * @bodyParam id int required The id of the Store. Example: 1
     *
     * @response 200 {
     *  "status": "Success",
     *  "message": "Store listing",
     *  "data": {
     *       "id": "2c4c5a3b-5289-4b26-9cea-43b955bb1881",
     *       "name": "Test Garcia Varona Maderas",
     *       "url": "https://pruebas.garciavarona.com",
     *       "key": "594f02d3b382bcc05878a10453e5dd82",
     *       "store_key": "88afd077fe11c20337209c643a21fe7b",
     *       "store_type_id": 45,
     *       "status": 1,
     *       "created_at": "2022-08-12T03:19:04.000000Z",
     *       "updated_at": "2022-08-12T03:19:04.000000Z"
     *    }
     * }
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function info(Store $store)
    {
        return $this->successResponse(
            __("Store"),
            $store
            );
    }

    /**
     * Update the specified resource in storage.
     * @authenticated
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

     /**
     * Update the specified resource in storage.
     * @authenticated
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStore(StoreUpdateRequest $request, $id)
    {
        $store = Store::find($id);

        if($store) {
            $store->update(($request->except(['image'])));
            if($request->file('image')){
                if($store->image) {
                    Storage::delete(['public/'.$store->image]);
                }
                $file_path =  'public/company/';
                $path = $request->file('image')->store($file_path);
                $store->image =  str_replace('public/','', $path);
                $store->update();
            }
            return $this->successResponse(
                __("Update Store"),
                    StoreResource::make($store)
                );
        } else {
            return $this->errorResponse('El id de la corporación no existe',null,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @authenticated
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    function getSalt() {
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randStringLen = 36;

        $randString = "";
        for ($i = 0; $i < $randStringLen; $i++) {
            $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
        }
        return $randString;
   }

}
