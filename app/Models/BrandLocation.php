<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiScope;
use Illuminate\Database\Eloquent\Builder;

class BrandLocation extends Model
{
    use HasFactory;
    use ApiScope;

    //Evita que se creen por masivos
    protected $guarded = ['id','created_at', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['brands','locations'];

    //para filtrar
    protected $allowFilter = ['id','brand_id','location_id'];

    //para ordenar
    protected $allowSort = ['id', 'brand_id','location_id'];



    //Relacion uno a muchos inversa
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }


    //Relacion uno a muchos inversa
    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
