<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\LoginUserRequest;
use App\Models\Store;

/**
 * @group Auth endpoints
 */
class AuthenticationController extends Controller
{
    use ApiResponser;

    /**
     * Display the information of the connected user
     *
     * @authenticated
     *
     * @response status=401 scenario="Unauthenticated" {
     *    "message": "Unauthenticated."
     *    }
     * }
     *
     * @response 200 {
     *   "status": "Success",
     *   "message": "Info user",
     *   "data": {
     *       "access_token": "1|mUjgFmhJlEZSd04wSchkKm4pGiZmHRftLW1RAxMA",
     *       "access_type": "Bearer",
     *       "user": {
     *           "id": 1,
     *           "name": "Admin",
     *           "email": "admin@turnover.com",
     *           "email_verified_at": null,
     *           "type": "admin",
     *           "status": 1,
     *           "store_id": null,
     *           "created_at": "2022-08-07T01:09:45.000000Z",
     *           "updated_at": "2022-08-07T01:09:45.000000Z",
     *           "roles": [
     *               {
     *                   "id": 1,
     *                   "name": "admin",
     *                   "guard_name": "web",
     *                   "created_at": "2022-08-07T01:09:45.000000Z",
     *                   "updated_at": "2022-08-07T01:09:45.000000Z",
     *                   "pivot": {
     *                       "model_id": 1,
     *                       "role_id": 1,
     *                       "model_type": "App\\Models\\User"
     *                   }
     *               }
     *           ]
     *       }
     *   }
     * }
     *
     * @return UserResource
     */
    public function user(){
        $user = auth()->user();
        $roles = $user->getRoleNames();
        $store = null;
        $store_id = $user->store_id;
        if($store_id) {
            $store = Store::where('id',$user->store_id)->first();
        }
        return $this->successResponse(
            __("Info user"),
            [
                "access_token" => request()->bearerToken(),
                "access_type" => 'Bearer',
                "user" => $user->toArray(),
                "rol" => $roles,
                "store" => $store
            ]
        );
    }

    /**
     * Handle a login request to the application.
     *
     * @bodyParam email email required The email of the user. Example: admin@turnover.com
     * @bodyParam password password required The password of the user. Example: @TurnOver
     *
     * @response status=422 scenario="Validation error" {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "email": [
     *            "El email es requerido"
     *        ]
     *    }
     * }
     * @response status=404 scenario="Not found" {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "email": [
     *            "El email no existe"
     *        ]
     *    }
     * }
     *
     * @response 200 {
     *  "status": "Success",
     *  "message": "Welcome, you are connected",
     *  "data": {
     *      "access_token": "1|mUjgFmhJlEZSd04wSchkKm4pGiZmHRftLW1RAxMA",
     *      "access_type": "Bearer",
     *      "user": {
     *          "id": 1,
     *          "first_name": "Admin",
     *          "last_name": "Turnover",
     *          "email": "admin@turnover.com",
     *          "roles": [
     *              {
     *                  "id": 1,
     *                  "name": "admin",
     *                  "guard_name": "web",
     *                  "created_at": "2022-08-07T01:09:45.000000Z",
     *                  "updated_at": "2022-08-07T01:09:45.000000Z",
     *                  "pivot": {
     *                      "model_id": 1,
     *                      "role_id": 1,
     *                      "model_type": "App\\Models\\User"
     *                  }
     *              }
     *          ]
     *      }
     *  }
     * }
     **/
    public function login(LoginUserRequest $request): JsonResponse {

        try {
            $user = User::select("id", "name", "password", "email", "type", "status", "store_id")
                ->where("email", request("email"))
                //->has('store')
                ->firstOrFail();

            if (! $user || ! Hash::check(request("password"), $user->password)) {
                throw ValidationException::withMessages([
                    'password' => ['La contraseña es incorrecta'],
                ]);
            }

            $token = $user->createToken($user->id.'-'.$user->email,[$user->getRoleNames()])->plainTextToken;

            $store = null;
            $store_id = $user->store_id;
            if($store_id) {
                $store = Store::where('id',$user->store_id)->first();
            }


            return $this->successResponse(
                __("Welcome, you are connected to Goviideo"),
                [
                    "access_token" => $token,
                    "access_type" => 'Bearer',
                    "user" => $user->toArray(),
                    "store" => $store
                ]
            );
        } catch (ModelNotFoundException $ex) {
            return $this->errorResponse('El email no existe',$ex,404);
        }
    }

    /**
     * Logout the user out of the application.
     *
     * @authenticated
     * @response status=204 scenario="Success" {}
     * @response status=400 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse {
            $token = request()->bearerToken();

            /** @var PersonalAccessToken $model */
            $model = Sanctum::$personalAccessTokenModel;

            $accessToken = $model::findToken($token);
            $accessToken->delete();

            return $this->success(
                __("Hasta la próxima!"),
                null,
                204,
            );
        }
    }

