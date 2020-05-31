<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTankAPIRequest;
use App\Http\Requests\API\UpdateTankAPIRequest;
use App\Models\Tank;
use App\Repositories\TankRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TankController
 * @package App\Http\Controllers\API
 */

class TankAPIController extends AppBaseController
{
    /** @var  TankRepository */
    private $tankRepository;

    public function __construct(TankRepository $tankRepo)
    {
        $this->tankRepository = $tankRepo;
    }

    /**
     * Display a listing of the Tank.
     * GET|HEAD /tanks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tanks = $this->tankRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tanks->toArray(), 'Tanks retrieved successfully');
    }

    /**
     * Store a newly created Tank in storage.
     * POST /tanks
     *
     * @param CreateTankAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTankAPIRequest $request)
    {
        $input = $request->all();

        $tank = $this->tankRepository->create($input);

        return $this->sendResponse($tank->toArray(), 'Tank saved successfully');
    }

    /**
     * Display the specified Tank.
     * GET|HEAD /tanks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tank $tank */
        $tank = $this->tankRepository->find($id);

        if (empty($tank)) {
            return $this->sendError('Tank not found');
        }

        return $this->sendResponse($tank->toArray(), 'Tank retrieved successfully');
    }

    /**
     * Update the specified Tank in storage.
     * PUT/PATCH /tanks/{id}
     *
     * @param int $id
     * @param UpdateTankAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTankAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tank $tank */
        $tank = $this->tankRepository->find($id);

        if (empty($tank)) {
            return $this->sendError('Tank not found');
        }

        $tank = $this->tankRepository->update($input, $id);

        return $this->sendResponse($tank->toArray(), 'Tank updated successfully');
    }

    /**
     * Remove the specified Tank from storage.
     * DELETE /tanks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tank $tank */
        $tank = $this->tankRepository->find($id);

        if (empty($tank)) {
            return $this->sendError('Tank not found');
        }

        $tank->delete();

        return $this->sendSuccess('Tank deleted successfully');
    }
}
