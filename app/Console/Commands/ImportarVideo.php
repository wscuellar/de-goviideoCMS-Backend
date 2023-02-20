<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Api\Hihaho\UserTokenController;
use App\Models\UserToken;
use App\Models\VideoHihaho;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ImportarVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userToken = new UserTokenController();
        $userToken->userToken();
        $token = $userToken->getToken();

        $page = request('page') ? '?page='.request('page') : '';

        $this->line('');
        $this->line('<fg=green>IMPORTAR VIDEOS</>');
        $this->line('');
        $this->line('<fg=white>--------------------------------------------------------------------------</>');
        $this->line('');
        $response = Http::accept('application/json')
                    ->withToken($token)
                    ->get(env('HIHAHO_URL').'/v2/video');

        if ($response->status()==200)
        {
            $result = json_decode($response->getBody(), true);
            $data = collect($result['data']);
            //dd($data);
            $meta = $result['meta'];
            //dd($meta);
            $total = $meta['total'];

            $per_page = $meta['per_page'];
            $this->line('Por pagina: '.$per_page);
            $this->line('Total: '.$total);
            $paginas = $meta['last_page'];
            $this->line('Paginas: '.$paginas);
            for ($i = 1; $i <= $paginas; $i++) {
                $processed = $this->getPages($i, $token);
            }

        } else {
            $this->line('<fg=red>ERROR DE CONEXION</>');
        }

        return Command::SUCCESS;
    }


    private function getPages($page, $token)
    {
        $response = Http::accept('application/json')
                    ->withToken($token)
                    ->get(env('HIHAHO_URL').'/v2/video?page='.$page);
        if ($response->status()==200)
        {
            $result = json_decode($response->getBody(), true);
            $videos = collect($result['data']);
            foreach($videos as $video)
            {
                $description = $video['description'];
                $display_name = $video['display_name'];
                $id = $video['id'];
                $status = $video['status'];
                $uuid = $video['uuid'];
                $video_container_id = $video['video_container_id'];
                $video_container = $video['video_container'];
                $created_at = $video['created_at'];


                $detalle = 'NO DATOS';
                $embed_url = '';
                $iframe_element = '';
                $player_url = '';
                $thumbnails_big = '';
                $thumbnails_small = '';
                $start_time = 0;
                $end_time = 0;
                $duration = 0;
                $statistics =0;

                //Buscar detalle del video
                $response2 = Http::accept('application/json')
                    ->withToken($token)
                    ->get(env('HIHAHO_URL').'/v2/video/'.$id);

                if ($response2->status()==200)
                {
                    $detalle = 'OK';
                    $result2 = json_decode($response2->getBody(), true);
                    $vid = $result2['data'];
                    //dd($vid);
                    $embed_url = $vid['embed_url'];
                    $iframe_element = $vid['iframe_element'];
                    $player_url = $vid['player_url'];
                    $thumbnails_big = $vid['thumbnails']['big'];
                    $thumbnails_small = $vid['thumbnails']['small'];
                    $start_time = $vid['start_time'];
                    $end_time = $vid['end_time'];
                    $duration = $vid['duration'];
                    $created_at = $vid['created_at'];
                }

                //Buscar si tiene estadisticas
                $response3 = Http::accept('application/json')
                    ->withToken($token)
                    ->get(env('HIHAHO_URL').'/v2/video/'.$id.'/aggregated-statistics');
                if ($response3->status()==200)
                {
                    $statistics =1;
                }

                $video = VideoHihaho::updateOrCreate(
                    ['video_uuid' =>  $uuid],
                    [
                        'description' => $description,
                        'display_name' => $display_name,
                        'video_id' => $id,
                        'status' => $status,
                        'video_container_id' => $video_container_id,
                        'video_container' => $video_container,
                        'iframe_element' => $iframe_element,
                        'embed_url' => $embed_url,
                        'player_url' => $player_url,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'duration' => $duration,
                        'thumbnails_big' => $thumbnails_big,
                        'thumbnails_small' => $thumbnails_small,
                        'created_at' => $created_at,
                        'statistics' => $statistics
                    ]
                );
                $ini ='';
                $end ='';
                if($statistics==1)
                {
                    $ini ='<fg=yellow>';
                    $end ='</>';
                }
                $this->line($ini.$id.' '.$display_name.' '.$detalle.' '.$statistics.$end);
            }
        } else {
            $this->line('<fg=red>ERROR DE CONEXION</>');
        }

    }
}
