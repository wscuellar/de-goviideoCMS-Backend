<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ResetEmailPassword;
use App\Http\Requests\Auth\ResetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use Carbon\Carbon;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

/**
 * @group Password reset endpoints
 */
class PasswordResetController extends Controller
{

    use ApiResponser;

    /**
     * Send email to retrieve password
     *
     * @bodyParam email email required The email of the user. Example: admin@turnover.com
     *
     * @response status=404 scenario="Not found" {
     *  "status": "Error",
     *  "message": "We can't find a user with that email address.",
     *  "data": null
     * }
     *
     * @response 200 {
     *  "status": "Success",
     *   "message": "Reset link by email",
     *   "data": {
     *       "message": "We have sent your password reset link by email!"
     *   }
     *
     * @param ResetEmailPassword $request
     * @return JsonResponse
     */
    public function email(ResetEmailPassword $request): JsonResponse
    {

        $user = User::where('email', $request->email)->first();
        if (!$user)  {
            return $this->errorResponse("El email no existe",null,404);
        }

        //TODO::mejorar funcion base
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
            ]
        );
        if ($passwordReset) {
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
            return $this->successResponse(
                __("Reset link by email"),
                [
                    'message' => 'Te hemos enviado su enlace de restablecimiento de contraseña por correo electrónico',
                ]
            );
        }
    }

    /**
     * Find token password reset
     *
     * @bodyParam token string required The token password reset of the user. Example: nc83c6FzuZ2dGAzw95RKcTtzNcyAQR2s
     *
     * @response 200 {
     * "status": "Success",
     * "message": "Reset password",
     * "data": {
     *  "id": 4,
     *   "email": "admin@turnover.com",
     *   "token": "mbvGBXxef4to61FiFiXM9dk1HBkKbQnO0ob4HCUVqtI8or9RJpxDpXfZKCta",
     *   "created_at": "2022-08-11T16:56:32.000000Z",
     *   "updated_at": "2022-08-11T16:56:32.000000Z"
     *
     *   }
     * }
     * @param  [string] $token
     * @return JsonResponse [string] message
     */
    public function find($token):JsonResponse
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return $this->errorResponse('Este token de restablecimiento de contraseña no es válido',null,404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(60)->isPast()) {
            $passwordReset->delete();
            return $this->errorResponse('Este token de restablecimiento de contraseña expiró',null,404);
        }

        return $this->successResponse(
            __("Find token password reset"),
            $passwordReset
        );

    }

    /**
     * Reset password
     *
     * @bodyParam token string required The token password reset of the user. Example: nc83c6FzuZ2dGAzw95RKcTtzNcyAQR2s
     * @bodyParam email email required The email of the user. Example: admin@turnover.com
     * @bodyParam password password required The new password of the user. Example: @TurnOver
     * @bodyParam password_confirmation password required The password confirmation of the user. Example: @TurnOver
     *
     * @response status=422 scenario="Validation error" {
     * {
     *       "password": [
     *           "The password confirmation does not match."
     *       ]
     *   }
     * @response status=404 scenario="Not found" {
     * {
     *       "password": [
     *           "This password reset token is invalid."
     *       ]
     * }
     *
     * @response 200 {
     * "status": "Success",
     * "message": "Reset password",
     * "data": {
     *        "id": 1,
     *       "first_name": "Admin",
     *       "last_name": "Turnover",
     *       "email": "oscar.lobo@dckstudios.com",
     *       "type": 2,
     *       "status": 1,
     *       "store_id": null,
     *       "created_at": "2022-08-10T05:41:32.000000Z",
     *       "updated_at": "2022-08-10T05:49:59.000000Z"
     *   }
     * }
     *
     * @response status=422 scenario="Validation error" {
     * {
     *       "message": "Debe confirmar la contraseña.",
     *       "errors": {
     *           "password": [
     *               "Debe confirmar la contraseña."
     *           ]
     *       }
     *   }
     *
     * @response status=422 scenario="Validation error" {
     *
     *       "message": "La contraseña es requerida",
     *       "errors": {
     *           "password": [
     *               "La contraseña es requerida"
     *           ],
     *            "password": [
     *                   "Debe confirmar la contraseña."
     *            ]
     *       }
     *   }
     *
     *
     *
     *
     * @param ResetPassword $request
     * @return JsonResponse [json] user object
     */
    public function reset(ResetPassword $request):JsonResponse
    {
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'Este token de restablecimiento de contraseña no es válido'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'El email no existe'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();

        return $this->successResponse(
            __("Contraseña actualizada"),
            $user
        );

    }

    /**
     * Actuaizacion de contraseña de usuario
     *
     * @authenticated
     *
     * @bodyParam user int required Id del usuario. Example: a1
     * @bodyParam password_old password required Contraseña actual del usuario. Example: @TurnOver
     * @bodyParam password password required Nueva contraseña. Example: @TurnOver
     * @bodyParam password_confirmation password required Confirmacion de la contraseña de usuario. Example: @TurnOver

     * @response 200 {
     * "status": "Success",
     * "message": "Contraseña actualizada",
     * "data": {
     *        "id": 1,
     *       "first_name": "Admin",
     *       "last_name": "Turnover",
     *       "email": "oscar.lobo@dckstudios.com",
     *       "phone": "+34 123 456 7890",
     *       "cif": "M123443219",
     *       "iban": "ES00 4567 8901 2345 6789 00",
     *       "work_position": "Retail Country manager",
     *       "postal_code": "01084 Palau-Solita i Plegamans",
     *       "city": "Barcelona (España)",
     *       "address": "Calle Mercades 9-11, Pol. Ind. Riera de Caldes",
     *       "email_verified_at": null,
     *       "type": 2,
     *       "status": 1,
     *       "customer_id": null,
     *       "store_id": null,
     *       "created_at": "2022-08-10T05:41:32.000000Z",
     *       "updated_at": "2022-08-10T05:49:59.000000Z"
     *   }
     * }
     *
     * @response status=404 scenario="Not found" {
     * {
     *       "password": [
     *           "La contraseña es incorrecta"
     *       ]
     * }
     *
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function updatePassword(Request $request, User $user){

        //dd($user->password);
        $request->validate([
            "password_old" => "required",
            "password" => "required|min:6|max:30|confirmed",
            ],[
                "password_old.required" => "La contraseña anterior es requerida",
                "password.required" => "La contraseña es requerida",
                "password.min" => "La contraseña debe contener mínimo 6 caracteres",
                "password.confirmed" => "Las contraseñas ingresadas no son iguales",
            ]
        );

        if (! $user || ! Hash::check(request("password_old"), $user->password)) {
            throw ValidationException::withMessages([
                'password_old' => ['La contraseña actual es incorrecta'],
            ]);
        }

        if($request->password==$request->password_old){
            return response()->json([
                'message' => 'La nueva contraseña es igual a la contraseña actual'
            ], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();


        return $this->successResponse(
            __("Contraseña actualizada"),
            $user
        );

    }

}
