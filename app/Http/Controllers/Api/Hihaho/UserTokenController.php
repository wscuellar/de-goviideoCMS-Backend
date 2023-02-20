<?php

namespace App\Http\Controllers\Api\Hihaho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\UserToken;
use App\Traits\ApiResponser;

class UserTokenController extends Controller
{
    use ApiResponser;

    public function userToken()
    {
        $apiURL = env('HIHAHO_URL').'/oauth/access_token';
          // POST Data
          $postInput = [
            'grant_type' => 'password',
            'username' => env('HIHAHO_USER'),
            'password' => env('HIHAHO_PASSWORD'),
            'client_id' => env('HIHAHO_CLIENT_ID'),
            'client_secret' => env('HIHAHO_CLIENT_SECRET')
        ];
        $response = Http::post($apiURL, $postInput);

        $statusCode = $response->status();

        //self::ddJson($statusCode);

        if($statusCode == 200)
        {
            $responseBody = json_decode($response->getBody(), true);
            $user = env('HIHAHO_USER');
            $token_type = $responseBody['token_type'];
            $token = $responseBody['access_token'];
            $expires_in = $responseBody['expires_in'];
            $refresh_token = $responseBody['refresh_token'];
            UserToken::where('status',1)
                ->update([
                    'status' => 0
                ]);

            $usertoken = UserToken::create([
                'name' => $user,
                'accesstoken' => $token,
                'refresh_token' => $refresh_token,
                'status' => 1,
                'expires_in' => $expires_in,
                'date' => now()->format('Y-m-d')
            ]);

            return $this->successResponse(
                __("User Token"),
                [
                    'name' => $user,
                    'accesstoken' => $token,
                    'status' => 1,
                    'date' => now()->format('Y-m-d')
                ]
            );
        } else {
            return $this->errorResponse('No se puede conectar', $statusCode, 404);
        }
    }


     /**
     * retorna el token activo
     *
     * @return void
     */
    public function getToken()
    {
        $token = UserToken::select('accesstoken')
             ->where('status', 1)
             ->first();
         return $token->accesstoken;
     }


     public function refreshToken()
     {
     }
}
