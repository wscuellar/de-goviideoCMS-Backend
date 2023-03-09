<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use App\Traits\ApiScope;

class VideoHihaho extends Model
{
    use HasFactory;
    use ApiScope;

    //Evita que se creen por masivos
    protected $guarded = ['id', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['videostatistics', 'store'];

    //para filtrar
    protected $allowFilter = ['id', 'video_uuid', 'video_id', 'display_name', 'description', 'status',
    'store_id', 'location_id', 'brand_id', 'statistics'];

    //para ordenar
    protected $allowSort = ['id', 'video_uuid', 'display_name','description', 'status',
    'store_id', 'location_id', 'brand_id', 'created_at', 'statistics', 'video_id'];


    /**
	 * The table associated with the model.
	 *
	 * @var string
	*/
	protected $table = 'video_hihaho';

    /**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'video_container' => 'json'
	];

    //Relacion uno a muchos inversa
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function videostatistics()
    {
        return $this->hasMany(VideoStatistics::class, 'video_hihaho_id');
    }

    /**
	 * Set exchange rate as a JSON without escaped quotes.
	 *
	 * @param  string  $value
	 * @return void
	 */
	// public function setVideoContainerAttribute($value)
	// {
	// 	$this->attributes['video_container'] = stripslashes($value);
	// }

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
