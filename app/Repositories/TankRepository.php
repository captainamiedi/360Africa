<?php

namespace App\Repositories;

use App\Models\Tank;
use App\Repositories\BaseRepository;

/**
 * Class TankRepository
 * @package App\Repositories
 * @version May 30, 2020, 5:29 pm UTC
*/

class TankRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'volume',
        'name',
        'location_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tank::class;
    }
}
