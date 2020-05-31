<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNewVolumeAPIRequest;
use App\Http\Requests\API\UpdateNewVolumeAPIRequest;
use App\Models\NewVolume;
use App\Repositories\NewVolumeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NewVolumeController
 * @package App\Http\Controllers\API
 */

class NewVolumeAPIController extends AppBaseController
{
    /** @var  NewVolumeRepository */
    private $newVolumeRepository;

    public function __construct(NewVolumeRepository $newVolumeRepo)
    {
        $this->newVolumeRepository = $newVolumeRepo;
    }

    /**
     * Display a listing of the NewVolume.
     * GET|HEAD /newVolumes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $newVolumes = $this->newVolumeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($newVolumes->toArray(), 'New Volumes retrieved successfully');
    }

    /**
     * Store a newly created NewVolume in storage.
     * POST /newVolumes
     *
     * @param CreateNewVolumeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNewVolumeAPIRequest $request)
    {
        $input = $request->all();

        $newVolume = $this->newVolumeRepository->create($input);

        return $this->sendResponse($newVolume->toArray(), 'New Volume saved successfully');
    }

    /**
     * Display the specified NewVolume.
     * GET|HEAD /newVolumes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var NewVolume $newVolume */
        $newVolume = $this->newVolumeRepository->find($id);

        if (empty($newVolume)) {
            return $this->sendError('New Volume not found');
        }

        return $this->sendResponse($newVolume->toArray(), 'New Volume retrieved successfully');
    }

    /**
     * Update the specified NewVolume in storage.
     * PUT/PATCH /newVolumes/{id}
     *
     * @param int $id
     * @param UpdateNewVolumeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNewVolumeAPIRequest $request)
    {
        $input = $request->all();

        /** @var NewVolume $newVolume */
        $newVolume = $this->newVolumeRepository->find($id);

        if (empty($newVolume)) {
            return $this->sendError('New Volume not found');
        }

        $newVolume = $this->newVolumeRepository->update($input, $id);

        return $this->sendResponse($newVolume->toArray(), 'NewVolume updated successfully');
    }

    /**
     * Remove the specified NewVolume from storage.
     * DELETE /newVolumes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var NewVolume $newVolume */
        $newVolume = $this->newVolumeRepository->find($id);

        if (empty($newVolume)) {
            return $this->sendError('New Volume not found');
        }

        $newVolume->delete();

        return $this->sendSuccess('New Volume deleted successfully');
    }
}
