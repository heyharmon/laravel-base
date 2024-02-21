<?php

namespace DDD\Http\Base\Statuses;

use DDD\App\Controllers\Controller;
use DDD\Domain\Base\Statuses\Resources\StatusResource;
// Models
use DDD\Domain\Base\Statuses\Status;
// Resources
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::parents()->latest()->get();

        return StatusResource::collection($statuses);
    }

    public function store(Request $request)
    {
        $status = Status::create($request->all());

        return new StatusResource($status);
    }

    public function show(Status $status)
    {
        $status = $status->descendantsAndSelf()->get()->toTree();

        return new StatusResource($status->first());
    }

    public function update(Status $status, Request $request)
    {
        $status->update($request->all());

        return new StatusResource($status);
    }

    public function destroy(Status $status)
    {
        $status->delete();

        return new StatusResource($status);
    }
}
