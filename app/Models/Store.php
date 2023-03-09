<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Uuids;
use App\Traits\ApiScope;

class Store extends Model
{
    use Uuids;
    use HasFactory;
    use ApiScope;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','created_at', 'updated_at'];

    //para incluir relaciones
    protected $allowIncluded = ['brands','brands.collections','users'];

    //para filtrar
    protected $allowFilter = ['id', 'name','nif_dni','status', 'image_path','url', 'name_account', 'fiscal_year', 'domain', 'city', 'state', 'country', 'zip_code'];

    //para ordenar
    protected $allowSort = ['id', 'name','nif_dni','status','address','url', 'name_account', 'fiscal_year', 'domain', 'city', 'state', 'country', 'zip_code'];

    //Relacion usuarios uno a muchos
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function concessionaires()
    {
        return $this->hasMany(Concessionaire::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function videossynthesia()
    {
        return $this->hasMany(VideoSynthesia::class);
    }

    public function videoshihaho()
    {
        return $this->hasMany(VideoHihaho::class);
    }







}
