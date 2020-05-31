<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/31/2020
 * Time: 12:13 AM
 */

namespace App\Services;


use App\Models\NewVolume;

class VolumeChange
{
    private $liquidTransfer;

    public function __construct(LiquidTransfer $liquidTransfer)
    {
        $this->liquidTransfer = $liquidTransfer;
    }

    public function oldLiquidContent($id)
    {

        $newContent = NewVolume::find($id); // with in laravel can be used to get volume of both tanks.

        $oldContent = $this->liquidTransfer->getVolume($newContent->tank_id);

        if ($oldContent > $newContent->volume){
            $difference = $oldContent - $newContent->volume;
        } else {
            $difference = $newContent->volume - $oldContent;
        }

//        $difference = $oldContent - $newContent;

        return [
            'oldContent' => $oldContent,
            'newContent' => $newContent->volume,
            'difference' => $difference,
        ];
    }
}