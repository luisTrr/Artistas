<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Albune
 *
 * @property $id
 * @property $artista_id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Artista $artista
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Albune extends Model
{
    
    static $rules = [
		'artista_id' => 'required',
		'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['artista_id','nombre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function artista()
    {
        return $this->hasOne('App\Models\Artista', 'id', 'artista_id');
    }
    

}
