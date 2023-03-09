<?php

namespace App\Http\Controllers\Api\Hihaho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoHihaho;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Traits\ApiResponser;
class VideoController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function getAllVideos()
    {
        $user = auth()->user();

        if($user->type == 'admin')
        {
            $videos = VideoHihaho::whereIn('status', [2,3])
                    ->whereNull('store_id')
                    ->orderBy('statistics', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->filter()
                    ->sort()
                    ->getOrPaginate();

            return $this->successResponse(
                __("Videos HIHAHO"),
                    $videos
                );
        } else {
            return $this->errorResponse('No es un administrador, no puede realizar consultas', null, 404);
        }
    }

    public function getAllVideosAsignados()
    {
        $user = auth()->user();

        if($user->type == 'admin')
        {
        $videos = VideoHihaho::whereIn('status', [2,3])
                ->whereNotNull('store_id')
                ->orderBy('statistics', 'desc')
                ->orderBy('created_at', 'desc')
                ->filter()
                ->sort()
		        ->getOrPaginate();

        return $this->successResponse(
            __("Videos HIHAHO"),
                $videos
            );
        } else {
            return $this->errorResponse('No es un administrador, no puede realizar consultas', null, 404);
        }
    }

    public function getVideosGeneral()
    {
        $user = auth()->user();

        if($user->type == 'admin')
        {
            $videos = VideoHihaho::orderBy('statistics', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->filter()
                    ->sort()
                    ->getOrPaginate();

            return $this->successResponse(
                __("Videos HIHAHO"),
                    $videos
                );
        } else {
            return $this->errorResponse('No es un administrador, no puede realizar consultas', null, 404);
        }
    }

    public function VideoToStore($id)
    {
        $videos = VideoHihaho::whereIn('status', [2,3])
                ->where('store_id', $id)
                ->orderBy('statistics', 'desc')
                ->orderBy('created_at', 'desc')
                ->filter()
                ->sort()
		        ->getOrPaginate();

        return $this->successResponse(
            __("Videos HIHAHO"),
                $videos
            );
    }

    public function addVideoToStore($id)
    {
        $user = auth()->user();

        if($user->type == 'admin' || $user->type == 'store')
        {
            $store_id = request("store_id");

            if($store_id)
            {
                $video = VideoHihaho::find($id);
                if($video)
                {
                    $video->store_id = $store_id;
                    $video->update();
                    return $this->successResponse(
                        __("Video actualizado"),
                            $video
                        );
                } else {
                    return $this->errorResponse('Id del video no encotrado', null, 404);
                }
            } else {
                    return $this->errorResponse('Se requiere el id del cliente', null, 404);
            }
        } else {
            return $this->errorResponse('No tiene permisos', null, 404);
        }

    }

    public function addVideoToBrand($id)
    {
        $user = auth()->user();

        if($user->type == 'admin' || $user->type == 'store')
        {
            $brand_id = request("brand_id");

            if($brand_id)
            {
                $video = VideoHihaho::find($id);
                if($video)
                {
                    $video->brand_id = $brand_id;
                    $video->update();
                    return $this->successResponse(
                        __("Video actualizado"),
                            $video
                        );
                } else {
                    return $this->errorResponse('Id del video no encotrado', null, 404);
                }
            } else {
                    return $this->errorResponse('Se requiere el id de la marca', null, 404);
            }
        } else {
            return $this->errorResponse('No tiene permisos', null, 404);
        }
    }

    public function addVideoToLocation($id)
    {
        $user = auth()->user();

        if($user->type == 'admin' || $user->type == 'store')
        {
            $location_id = request("location_id");

            if($location_id)
            {
                $video = VideoHihaho::find($id);
                if($video)
                {
                    $video->location_id = $location_id;
                    $video->update();
                    return $this->successResponse(
                        __("Video actualizado"),
                            $video
                        );
                } else {
                    return $this->errorResponse('Id del video no encotrado', null, 404);
                }
            } else {
                    return $this->errorResponse('Se requiere el id de la sucursal', null, 404);
            }
        } else {
            return $this->errorResponse('No tiene permisos', null, 404);
        }
    }
}
