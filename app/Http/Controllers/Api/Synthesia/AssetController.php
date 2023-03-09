<?php

namespace App\Http\Controllers\Api\Synthesia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Traits\ApiResponser;
use App\Http\Resources\AssetsResource;

class AssetController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getAvatar()
    {
        $avatars = Asset::where('type', 'avatar')
                ->where('status', true)
                ->orderBy('name')
                ->get();

        return $this->successResponse(
            __("Avatar Synthesia"),
            AssetsResource::collection($avatars)
            );
    }


    public function getBackgrounds()
    {
        $avatars = Asset::where('type', 'background')
                ->where('status', true)
                ->orderBy('attribute')
                ->orderBy('attribute')
                ->get();

        return $this->successResponse(
            __("Background Avatar Synthesia"),
            AssetsResource::collection($avatars)
            );
    }

    public function getVoices()
    {
        $avatars = Asset::where('type', 'voice')
                ->where('status', true)
                ->orderBy('attribute')
                ->orderBy('attribute')
                ->get();

        return $this->successResponse(
            __("Voice Avatar Synthesia"),
            AssetsResource::collection($avatars)
            );
    }

    public function getSoundTrack()
    {
        $avatars = Asset::where('type', 'other')
                ->where('status', true)
                ->orderBy('attribute')
                ->orderBy('attribute')
                ->get();

        return $this->successResponse(
            __("soundtrack Avatar Synthesia"),
            AssetsResource::collection($avatars)
            );
    }
}
