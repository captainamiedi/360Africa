<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tank
 * @package App\Models
 * @version May 30, 2020, 5:29 pm UTC
 *
 * @property \App\Models\Location $location
 * @property integer $volume
 * @property string $name
 * @property integer $location_id
 */
class Tank extends Model
{
    use SoftDeletes;

    public $table = 'tanks';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'volume',
        'name',
        'location_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'volume' => 'integer',
        'name' => 'string',
        'location_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'volume' => 'required',
        'location_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function location()
    {
        return $this->belongsTo(\App\Models\Location::class, 'location_id');
    }
}
