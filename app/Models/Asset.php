<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\ApiScope;

class Asset extends Model
{
    use HasFactory;
    use ApiScope;

    const IMAGE = 'image';
    const VOICE = 'voice';
    const VIDEO = 'video';
    const AVATAR = 'avatar';
    const BACKGROUND = 'background';
    const UPLOADS = 'uploads';
    const OTHER = 'other';

    //Evita que se creen por masivos
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
	 * The table associated with the model.
	 *
	 * @var string
	*/
	protected $table = 'assets';

}
