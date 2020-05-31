<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 5/30/2020
 * Time: 5:33 PM
 */

namespace App\Services;


use App\Models\Tank;

class LiquidTransfer
{
    private $volume;

    public function __construct()
    {
        $this->volume = 0;
    }

    public function TransferContent($tank1, $tank2)
    {
        $firstTank= Tank::find($tank1);
        $firstTankVolume = $firstTank->volume;
        $secondTank = Tank::find($tank2);
        $secondTankVolume = $secondTank->volume;
        $newSecondTankVolume = $secondTankVolume + $firstTankVolume;
        return [
            'message' => 'herere',
            'new Volume' => $newSecondTankVolume
        ];
    }

    public function sum()
    {
        $tankSum = Tank::get()->sum('volume');

        return ['sum of tank' => $tankSum];
    }

    public function getVolume($id)
    {
        $tank = Tank::find($id);

        return $this->volume = $tank->volume;
    }
}