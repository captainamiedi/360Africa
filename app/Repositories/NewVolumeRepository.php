<?php

namespace App\Repositories;

use App\Models\NewVolume;
use App\Repositories\BaseRepository;

/**
 * Class NewVolumeRepository
 * @package App\Repositories
 * @version May 30, 2020, 11:10 pm UTC
*/

class NewVolumeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'volume',
        'tank_id'
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
        return NewVolume::class;
    }
}
