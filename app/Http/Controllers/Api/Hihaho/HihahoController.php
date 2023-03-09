<?php

namespace App\Http\Controllers\Api\Hihaho;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserToken;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\VideoHihaho;
use App\Models\VideoStatistics;
use App\Http\Controllers\Api\Hihaho\UserTokenController;

class HihahoController extends Controller
{
    use ApiResponser;

      //para incluir relaciones
      protected $allowIncluded = ['page','q'];

    public function getAllVideos()
    {
        $page = request('page') ? '?page='.request('page') : '';
        $token = new UserTokenController();
        //dd($token->getToken());
        $response = Http::accept('application/json')
                    ->withToken($token->getToken())
                    //->withBody('application/json')
                    ->get(env('HIHAHO_URL').'/v2/video'.$page);

        if ($response->status()==200)
        {
            $result = json_decode($response->getBody(), true);
            //$collection = collect($response->json()['data']);
            //$filtered = $collection->whereIn('status', [3]);
            return $result;
            //return $result['data'];
        } elseif ($response->status()==401) {
            $token->userToken();
            $response = Http::accept('application/json')
            ->withToken($token->getToken())
            //->withBody('application/json')
            ->get(env('HIHAHO_URL').'/v2/video');
            if ($response->status()==200)
            {
                $result = json_decode($response->getBody(), true);
                return $result['data'];
            } else {
                return $this->errorResponse('No se puede conectar', $response->status(), 404);
            }

        } else {
            return $this->errorResponse('No se puede conectar', $response->status(), 404);
        }
    }



    public function statisticsVideo($videoId)
    {
        $token = new UserTokenController();

        $response = Http::accept('application/json')
                    ->withToken($token->getToken())
                    ->withBody('application/json')
                    ->get(env('HIHAHO_URL').'/v2/video/'.$videoId.'/aggregated-statistics');

        if ($response->status()==200)
        {
            $result = json_decode($response->getBody(), true);
            return $result['result'];
        } else {
            $result = json_decode($response->getBody(), true);
            $message = $result['message'];
            return $this->errorResponse($message, $response->status(), $response->status());
        }

    }

    public function hihahoVideoToClientStatistics($videoId)
    {
        $token = new UserTokenController();

        $response = Http::accept('application/json')
                    ->withToken($token->getToken())
                    ->get(env('HIHAHO_URL').'/v2/video/'.$videoId.'/aggregated-statistics');

        if ($response->status()==200)
        {
            $video = VideoHihaho::where('video_id', $videoId)
                    ->first();

            $result = json_decode($response->getBody(), true);

            $view = $result['data']['aggregated_statistics']['views'];
            $started_views = $result['data']['aggregated_statistics']['started_views'];
            $finished_views = $result['data']['aggregated_statistics']['finished_views'];
            $i = 1;

            VideoStatistics::where('video_hihaho_id', $video->id)->delete();

            for($i; $i <= $view; $i++)
            {
                $happend = ($started_views >= $i) ? 1 : 0;
                $finished = ($finished_views >= $i) ? 1 : 0;
                $videoStatistics = new VideoStatistics();
                $videoStatistics->video_hihaho_id = $video->id;
                $videoStatistics->created_date = now();
                $videoStatistics->happened = $happend;
                $videoStatistics->finished = $finished;
                $videoStatistics->save();
            }

            //dd($view);
            $sessions = VideoHihaho::where('video_id', $videoId)
                ->with('videostatistics')
                ->first();
            //dd(json_decode($sessions->videostatistics));
            $data = collect($result['data']);
            $statistics = $sessions->videostatistics;
            $data->put('sessions_video', $statistics);
            return $data; //;
        } else {
            $result = json_decode($response->getBody(), true);
            $message = $result['message'];
            return $this->errorResponse($message, $response->status(), $response->status());
         }

    }


     public function hihahoVideoToClient($videoId)
    {
        $token = new UserTokenController();

        $response = Http::accept('application/json')
                    ->withToken($token->getToken())
                    ->get(env('HIHAHO_URL').'/v2/video/'.$videoId);

        if ($response->status()==200)
        {
            $result = json_decode($response->getBody(), true);
            return $result['data'];
        } else {
            return $this->errorResponse('No se puede conectar', $response->status(), 404);
        }

    }


}
