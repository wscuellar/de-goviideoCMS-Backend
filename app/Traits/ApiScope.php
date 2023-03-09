<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;


trait ApiScope
{

     /**
     * Funcion para generar filtros
     *
     * @param Builder $query
     * @return void
     */
    public function scopeFilter(Builder $query) {
        if (empty($this->allowFilter) || empty(request('filter'))){
            return;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);

        foreach ($filters as $filter => $value){
            if($allowFilter->contains($filter)){
                $query->where($filter, 'LIKE', '%'.$value.'%');
            }
        }
    }

    /**
     * Funcion para traer relaciones
     *
     * @param Builder $query
     * @return void
     */
    public function scopeIncluded(Builder $query) {
        if (empty($this->allowIncluded) || empty(request('included'))){
            return;
        }

        $relations = explode(',',request('included'));
        $allowIncluded = collect($this->allowIncluded);

        foreach ($relations as $key => $relationship) {
            if(!$allowIncluded->contains($relationship)) {
                //si no existe elimino del arreglo
                unset($relations[$key]);
            }
        }
        //recupero la relacion
        $query->with($relations);
    }

    /**
     * Funcion para Ordenar
     *
     * @param Builder $query
     * @return void
     */
    public function scopeSort(Builder $query) {
        if (empty($this->allowSort) || empty(request('sort'))){
            return;
        }

        $sortFields = explode(',',request('sort'));

        $allowSort = collect($this->allowSort);
        foreach ($sortFields as $sortField){
            $direction ='asc';
            if(substr($sortField,0,1) == '-'){
                $direction = 'desc';
                $sortField = substr($sortField,1);
            }
            if($allowSort->contains($sortField)){
                $query->orderBy($sortField,$direction);
            }
        }

    }

    /**
     * genera paginacion
     *
     * @param Builder $query
     * @return void
     */
    public function scopeGetOrPaginate(Builder $query) {
        if (request('pagination')){
            $perPage = intval(request('pagination'));
            if($perPage) {
                return $query->paginate($perPage);
            }
        }
        return $query->get();
    }
}
