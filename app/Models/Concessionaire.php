<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiScope;
use Illuminate\Database\Eloquent\Builder;

class Concessionaire extends Model
{
    use HasFactory;
    use ApiScope;

    //Evita que se creen por masivos
    protected $guarded = ['id','created_at', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['store'];

    //para filtrar
    protected $allowFilter = ['id', 'name','store_id','status','description'];

    //para ordenar
    protected $allowSort = ['id', 'name','store_id','status','description'];



    //Relacion uno a muchos inversa
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Funcion para Ordenar
     *
     * @param Builder $query
     * @return void
     */
    public function scopeName(Builder $query)
    {
        if (empty(request('name'))) {
            return;
        }
        $query->where('name', 'LIKE', '%'.request('name').'%');
    }

}
