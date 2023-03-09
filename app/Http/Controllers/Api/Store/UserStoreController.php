<?php

namespace App\Http\Controllers\Api\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\UserStoreResource;
use App\Http\Requests\Store\RegisterUserStoreController;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use App\Rules\EmailFormat;

class UserStoreController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index($store_id) : JsonResponse
    {
        $user = auth()->user();

        if($user->type == 'admin' || $user->type == 'store')
        {
            $data = User::where('store_id', $store_id)
                            ->name()
                            ->email()
                            ->sort()
                            ->getorpaginate();
            return $this->successResponse(
                     __("Stores Users listing"),
                        UserStoreResource::collection($data)
                );
        } else {
            return $this->errorResponse('No tiene permisos',null,404);
        }
    }

     /**
     * Store a newly created resource in storage.
     * @authenticated
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterUserStoreController $request, $store_id) : JsonResponse
    {
        $user = auth()->user();
        if($user->type == 'admin' || $user->type == 'store')
        {
            try
            {
                $clientUser = User::create([
                    'name' => $request->name,
                    'store_id' => $store_id,
                    'type' => 'store',
                    'status' => 1,
                    'email' => $request->email ,
                    'password' => bcrypt($request->password)
                ])->assignRole('store');

                return $this->successResponse(
                    __("New user registration created successfully"),
                        $clientUser
                    );

            } catch (ModelNotFoundException $ex)
            {
                return $this->errorResponse('error',$ex,404);
            }
        } else {
            return $this->errorResponse('No tiene permisos',null,404);
        }
    }

    public function updated(Request $request, $id) : JsonResponse {
        $user2 = auth()->user();
        if($user2->type == 'admin' || $user2->type == 'store')
        {
            $user = User::find($id);
            if($user)
            {
                request()->validate([
                    'name' => 'required',
                    'email' => ['required', new EmailFormat() , 'unique:users,email,'.$user->id]
                ],
                [
                    'name.required' => 'El nombre es requerido',
                    'email.required' => 'El email es requerido',
                    'email.unique' => 'El email ya se encuentra registrado'
                ]);

                $user->update($request->all());
                return $this->successResponse(
                    __("¡Usuario actualizado con éxito!"),
                    UserStoreResource::make($user)
                );
            } else {
                return $this->errorResponse('El usuario no existe', null, 404);
            }
        } else {
            return $this->errorResponse('No tiene permisos',null,404);
        }
    }

    public function destroy($id) : JsonResponse
    {
        $user2 = auth()->user();
        if($user2->type == 'admin' || $user2->type == 'store')
        {
            $user = User::find($id);
            if($user)
            {
                Log::info(print_r($user, true));
                $user->delete();
                return $this->successResponse(
                    __("¡Usuario eliminado!"),
                    'OK'
                    );
            } else {
                return $this->errorResponse('El id del usuario no existe', null, 404);
            }
        } else {
            return $this->errorResponse('No tiene permisos', null, 404);
        }
    }

    public function show($id) : JsonResponse
    {
        $user2 = auth()->user();
        if($user2->type == 'admin' || $user2->type == 'store')
        {
            $user = User::find($id);
            //Log::info(print_r($user, true));
            if($user)
            {
                return $this->successResponse(
                    __("User"),
                        UserStoreResource::make($user)
                    );
            } else {
                    return $this->errorResponse('El usuario no existe', null, 404);
            }
        } else {
                return $this->errorResponse('No tiene permisos', null, 404);
        }
    }


}
