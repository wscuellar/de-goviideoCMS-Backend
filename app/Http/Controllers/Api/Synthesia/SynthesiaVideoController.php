<?php

namespace App\Http\Controllers\Api\Synthesia;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\VideoSynthesia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\SynthesiaResource;
use App\Http\Requests\Synthesia\SynthesiaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
/**
* @group Video Synthesia endpoints
*/
class SynthesiaVideoController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Listado de todos los videos Synthesia
     *
     * @authenticated
     *
     * @response 200 {
     *
     * "status": "Success",
     * "message": "Video Synthesia",
     * "data": [
     *
     * ]
     * }
     * @return void
     */
    public function index()
    {
        $user = auth()->user();

        if($user->type == 'admin')
        {
            $videos = VideoSynthesia::included()
                    ->filter()
                    ->sort()
                    ->getOrPaginate();

            return $this->successResponse(
                __("Video Synthesia"),
                $videos
            );
        } else {
            return $this->errorResponse('No es un administrador, no puede realizar consultas', null, 404);
        }
    }

    /**
     * Crear un video Synthesia
     *
     * @param SynthesiaRequest $request
     * @return void
     */
    public function store(SynthesiaRequest $request)
    {
        $user = auth()->user();
        DB::beginTransaction();
        if($user->type == 'admin')
        {
        $video = VideoSynthesia::create($request->all());
        } elseif($user->type == 'store') {
            //Valido plan de la tienda
            $video = VideoSynthesia::create($request->all());
        }
        $ctaSettings = null;
        if($video->settings_label)
        {
            $ctaSettings = array(
                "label" => $request->settings_label,
                "url" => $request->settings_url
            );

        }
        $test = false;
        if($video->test=="true")
        {
            $test = true;
        }

        $description = ($video->description) ? $video->description : "";

        $settings = array(
            "voice" => $video->voice,
            "horizontalAlign" => $video->horizontal_aling,
            "style" => $video->style,
            "scale" => $video->scale
        );
        if($video->style=="circular")
        {
            $settings["backgroundColor"] = ($video->corporate) ? $video->corporate : "#FFFFFF";

            $settings = array(
            "voice" => $video->voice,
            "style" => $video->style,
            "scale" => $video->scale
        );
        }

        $input = array(
            "avatar" => $video->avatar,
            "scriptText" => $request->script_text,
            "background" => $video->background,
            "avatarSettings" => $settings,

        );



        $synthesia = array(
            "test" => $test,
            "title" => $video->title,
            "description" => $description,
            "visibility" => $video->visibility,
            "callbackId" => $video->callback_email,
            "input" => [$input]
        );

        if($ctaSettings)
        {
            $synthesia["ctaSettings"] =  $ctaSettings;
        }

        if($video->soundtrack)
        {
            $synthesia["soundtrack"] = $video->soundtrack;
        }

        $data =json_encode($synthesia, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        //dd($data);

        $response = Http::accept('application/json')
                    ->withHeaders(['Authorization' => env('SYNTHESIA_KEY')])
                    ->withBody($data,'application/json')
                    ->post(env('SYNTHESIA_URL').'/videos');

        if($response->status()==201) {
            $result = json_decode($response->getBody(),true);
            $video->video_uuid = $result['id'];
            $video->status_synthesia = $result['status'];
            $video->save();
            DB::commit();
            return $this->successResponse(
                __("Creado Video Synthesia"),
                $video
            );
        } else {
            DB::rollBack();
            $error =json_decode($response->getBody(), true);

            return $this->errorResponse('Error al crear el video', $error, $response->status());
        }
    }

    /**
     * Mostrar un video Synthesia
     *
     * @param [type] $id
     * @return void
     */
    public function show($id)
    {
        $user = auth()->user();
        $video = null;
        if($user->type == 'admin')
        {
            try
            {
                $video = VideoSynthesia::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return $this->errorResponse('No se encontro el video', null, 404);
            }
        } elseif($user->type == 'store') {
            $video = VideoSynthesia::where('id', $id)
                    ->where('store_id', $user->store_id)
                    ->first();
        }
        return $this->successResponse(
            __("Video Synthesia"),
            $video
        );
    }


    /**
     * Consulta video Synthesia y cambiar el estado de la base de datos
     *
     * @param [type] $id
     * @return void
     */
    public function status($id)
    {
        $user = auth()->user();
        $video = null;
        if($user->type == 'admin')
        {
            try
            {
                $video = VideoSynthesia::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return $this->errorResponse('No se encontro el video', null, 404);
            }
        } elseif($user->type == 'store') {
            $video = VideoSynthesia::where('id', $id)
                    ->where('store_id', $user->store_id)
                    ->first();
        }

        if($video->video_uuid)
        {
            $response = Http::accept('application/json')
                        ->withHeaders(['Authorization' => env('SYNTHESIA_KEY')])
                        ->get(env('SYNTHESIA_URL').'/videos/'.$video->video_uuid);

            if($response->status()==200) {
                $result = json_decode($response->getBody(),true);
                $video->status_synthesia = $result['status'];
                $video->download = $result['download'];
                $video->url = $result['download'];
                $video->duration = $result['duration'];
                $video->save();

                return $this->successResponse(
                    __("Video Synthesia"),
                    $result
                );
            } else {
                $error =json_decode($response->getBody(), true);
                return $this->errorResponse('Error al consultar el video en synthesia', $error, $response->status());
            }
        } else {
            return $this->errorResponse('No se encontro el video', null, 404);
        }

    }

    public function update(Request $request, $id)
    {
        try {
            $video = VideoSynthesia::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('No se encontro el video', null, 404);
        }

        if($video->video_uuid)
        {
            $visibility = ($request->visibility) ? '"visibility":"'.$request->visibility.'",' : '';

            $title = ($request->title) ? '"title":"'.$request->title.'",' : '';

            $description = ($request->description) ? '"description":"'.$request->description.'",' : '';

            $ctaSettings = null;

            if ($request->settings_label)
            {
                $ctaSettings = '"ctaSettings":{"label":"'.$request->settings_label.'", "url":"'.$request->settings_url.'"},';
            }

            $data = $title.$description.$ctaSettings.$visibility;
            $data =  substr($data, 0, -1);

            if($data)
            {
                $data = '{'.$data.'}';
                $data =json_encode($data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
                $data =json_decode($data, true);

                $response = Http::accept('application/json')
                            ->withBody($data,'application/json')
                            ->withHeaders(['Authorization' => env('SYNTHESIA_KEY')])
                            ->patch(env('SYNTHESIA_URL').'/videos/'.$video->video_uuid);
                if($response->status()==200)
                {
                    $result = json_decode($response->getBody(),true);
                    $video->update($request->all());

                    return $this->successResponse(
                        __("Actualizado Video Synthesia"),
                        $result
                    );

                } else {
                    $error =json_decode($response->getBody(), true);
                    return $this->errorResponse('Error al actualizar el video', $error, $response->status());
                }

            } else {
                return $this->errorResponse('No hay parametros a actualizar', null, 404);
            }

        } else {
            if($request)
            {
                $video->update($request->all());
                return $this->successResponse(
                    __("Video actualizado"),
                    $video
                );
            } else{
                return $this->errorResponse('No hay parametros a actualizar', null, 404);
            }
        }

    }

    /**
     * Eliminar un video Synthesia
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $video = null;
        if($user->type == 'admin')
        {
            try
            {
                $video = VideoSynthesia::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return $this->errorResponse('No se encontro el video', null, 404);
            }

            if($video->video_uuid)
            {
                $response = Http::accept('application/json')
                            ->withHeaders(['Authorization' => env('SYNTHESIA_KEY')])
                            ->delete(env('SYNTHESIA_URL').'/videos/'.$video->video_uuid);
                if($response->status()==204) {
                    $video->delete();
                    return $this->successResponse(
                        __("Video local y en Synthesia Eliminado"),
                        $video
                    );
                } else {
                    $error =json_decode($response->getBody(), true);
                    return $this->errorResponse('Error al eliminar el video en synthesia', $error, $response->status());
                }
            } else {
                $video->delete();
                return $this->successResponse(
                    __("Video Synthesia Eliminado"),
                    $video
                );
            }
        } else {
            return $this->errorResponse('No es un administrador, no puede realizar consultas', null, 404);
        }
    }

    /**
     * Listar videos Synthesia por cliente
     *
     * @return void
     */
    public function listVideo($id)
    {
        try {
            $videos = VideoSynthesia::where('store_id', $id)
                    ->included()
                    ->filter()
                    ->sort()
                    ->getOrPaginate();

            return $this->successResponse(
                __("Video Synthesia"),
                $videos
            );
        } catch (\Throwable $th) {
            return $this->errorResponse('Id de cliente no valido', null, 404);
        }
    }
}
