<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Store;

/**
 * @group Store endpoints
 */
class StoreController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

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
     *       "name": "Test Garcia Varona Maderas",
     *       "url": "https://pruebas.garciavarona.com",
     *       "key": "594f02d3b382bcc05878a10453e5dd82",
     *       "store_key": "88afd077fe11c20337209c643a21fe7b",
     *       "store_type_id": 45,
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
        $data = Store::where('status',1)->orderBy('name', 'asc')->get();

        return $this->successResponse(
            __("Store listing"),
             $data
            );
    }

    /**
     * Store a newly created resource in storage.
     * @authenticated
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
