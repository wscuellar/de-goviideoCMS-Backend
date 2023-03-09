<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiScope;

class VideoStatistics extends Model
{
    use HasFactory;
    use ApiScope;

    //Evita que se creen por masivos
    protected $guarded = ['id', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['video'];

    /**
	 * The table associated with the model.
	 *
	 * @var string
	*/
	protected $table = 'video_statistics';

     //para filtrar
     protected $allowFilter = ['id',  'video_hihaho_id', 'created_date'];

     //para ordenar
     protected $allowSort = ['id','video_hihaho_id', 'created_date'];

     //Relacion uno a muchos inversa
     public function video()
     {
         return $this->belongsTo(VideoHihaho::class);
     }
}
