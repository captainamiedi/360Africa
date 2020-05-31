<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LiquidTransfer;
use App\Services\VolumeChange;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

class LiquidController extends AppBaseController
{
    public function store(LiquidTransfer $liquidTransfer, Request $request)
    {

        try{
            response()->json([$liquidTransfer->TransferContent($request->tank_1, $request->tank_2)], 200);
        } catch (\Exception $e) {

        }
//        dd($liquidTransfer->TransferContent($request->tank_1, $request->tank_2));
    }

    public function sumOfDailyContent(LiquidTransfer $liquidTransfer)
    {
        try {
            return response()->json([$liquidTransfer->sum()], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
//        dd($liquidTransfer->sum());
    }

    public function volumeOffloading(VolumeChange $volumeChange, $id)
    {
        try {
            return response()->json([$volumeChange->oldLiquidContent($id)], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
