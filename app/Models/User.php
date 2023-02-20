<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\ApiScope;
use DateTimeInterface;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use ApiScope;


    const CLIENT = 'client';
    const STORE = 'store';
    const ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'type',
        'store_id',
        'profile_photo_path',
        'phone',
        'device_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


      //para incluir relaciones
      protected $allowIncluded = ['store'];


      //para ordenar
      protected $allowSort = ['id', 'name','store_id','status','type'];


       /**
	 * Prepare a date for array / JSON serialization.
	 *
	 * @param  \DateTimeInterface  $date
	 * @return string
	 */
	protected function serializeDate(DateTimeInterface $date)
	{
		return $date->format('Y-m-d');
	}

    public function store(){
        return $this->belongsTo(Store::class);
    }



    /**
     * Funcion para buscar por nombre
     *
     * @param Builder $query
     * @return void
     */
    public function scopeName(Builder $query)
    {
        if (empty(request('name')))
        {
            return;
        }
        $query->where('name', 'LIKE', '%'.request('name').'%');

    }


       /**
     * Funcion para buscar por Email
     *
     * @param Builder $query
     * @return void
     */
    public function scopeEmail(Builder $query)
    {
        if (empty(request('email')))
        {
            return;
        }
        $query->where('email', 'LIKE', '%'.request('email').'%');
    }



}
