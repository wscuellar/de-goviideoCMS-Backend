<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProfileUserStoreRequest;

/**
* @group User endpoints
*/
class UserController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Listado de usaurios
     *
     * @authenticated
     *
     *  @response 200 {
     *   {
     *       "status": "Success",
     *       "message": "Listado de usuarios",
     *       "data": [
     *           {
     *               "id": 1,
     *               "name": "Admin",
     *               "email": "oscar.lobo@dckstudios.com",
     *               "type": "store",
     *               "status": 1,
     *               "store_id": null,
     *               "profile_photo_path": "http://turnoverapi.test/storage/photos/4Msqg3LbCST312bEbv5dPJN8WMCFyzBMbbbrdPoG.jpg",
     *               "created_at": "2022-08-13T01:48:06.000000Z",
     *               "updated_at": "2022-08-13T03:17:59.000000Z"
     *           },
     *       ]
     *   }

     * @return \Illuminate\Http\Response
     */
    public function listUsers()
    {
        return $this->successResponse(
            __("Listado de usuarios"),
            User::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show user information
     *
     * @authenticated
     *
     * @bodyParam id int required The id of the user. Example: 1
     *
     * @response 200 {
     *     "id": 1,
     *     "first_name": "Admin",
     *     "last_name": "Turnover",
     *     "email": "admin@turnover.com",
     *     "email_verified_at": null,
     *     "type": 2,
     *     "status": 1,
     *     "customer_id": null,
     *     "store_id": null,
     *     "profile_photo_path": null,
     *     "created_at": "2022-08-09T05:04:34.000000Z",
     *     "updated_at": "2022-08-09T05:04:34.000000Z"
     * }
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function show($id)
    public function show($id)
    {
        //return $user;
        $user = User::findOrFail($id);
        if($user->store_id){
            $user = DB::table('users as u')
                ->select('u.id',
                'u.name',
                'u.email',
                //'u.password',
                'u.postal_code',
                'u.city',
                'u.address',
                'u.type',
                'u.status',
                'u.customer_id',
                'u.phone',
                'u.cif',
                'u.iban',
                'u.store_id',
                'u.work_position',
                's.name as store',
                'u.profile_photo_path'
                )
                ->join('stores as s','s.id','=','u.store_id')
                ->where('u.id',$id)
                ->get();
        }
        return $this->successResponse(
            __("User information"),
            $user
        );
    }

    /**
     * Actualización de datos del usuario.
     *
     * @authenticated
     *
     * @bodyParam name string required Nombres del usuario. Example: Oscar
     * @bodyParam email string required Email del usuario. Example: oscar.lobo@dckstudios.com
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileUserStoreRequest $request, $user)
    {

        $user = User::find($user);

        $user->update($request->all());

        return $this->successResponse(
            __("Usuario actualizado con exito"),
            $user
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @authenticated
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
