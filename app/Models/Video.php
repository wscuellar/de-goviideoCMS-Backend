<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiScope;
use Illuminate\Database\Eloquent\Builder;
use DateTimeInterface;

class Video extends Model
{
    use HasFactory;
    use ApiScope;

    //Evita que se creen por masivos
    protected $guarded = ['id','created_at', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['store'];

    //para filtrar
    protected $allowFilter = ['id', 'display_name','store_id','description'];

    //para ordenar
    protected $allowSort = ['id', 'display_name','store_id','status','description'];

      //Relacion uno a muchos inversa
      public function store()
      {
          return $this->belongsTo(Store::class);
      }

        /**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	*/
	protected $casts = [
        'info' => 'json',// Deserialize the JSON attribute
	];

    /**
	 * Set the Exchange Rate as a JSON without escaped quotes.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setInfo($value)
	{
		$this->attributes['info'] = stripslashes($value);
	}

    /**
	 * Prepare a date for array / JSON serialization.
	 *
	 * @param  \DateTimeInterface  $date
	 * @return string
	 */
	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d H:i:s');
	}

}
