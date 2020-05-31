<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NewVolume
 * @package App\Models
 * @version May 30, 2020, 11:10 pm UTC
 *
 * @property \App\Models\Tank $tank
 * @property integer $volume
 * @property integer $tank_id
 */
class NewVolume extends Model
{
    use SoftDeletes;

    public $table = 'new_volume';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'volume',
        'tank_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'volume' => 'integer',
        'tank_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'volume' => 'required',
        'tank_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tank()
    {
        return $this->belongsTo(\App\Models\Tank::class, 'tank_id');
    }
}
