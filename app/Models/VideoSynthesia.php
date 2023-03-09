<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiScope;

class VideoSynthesia extends Model
{
    use HasFactory;
    use ApiScope;

    //Evita que se creen por masivos
    protected $guarded = ['id', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['store', 'brands'];

    /**
	 * The table associated with the model.
	 *
	 * @var string
	*/
	protected $table = 'video_synthesia';

    //Relacion uno a muchos inversa
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    //Relacion uno a muchos inversa
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    //Relacion uno a muchos inversa
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
