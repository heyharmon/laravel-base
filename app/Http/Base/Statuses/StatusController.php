<?php

namespace DDD\Http\Base\Statuses;

use Illuminate\Http\Request;
use DDD\Domain\Base\Statuses\Status;
use DDD\Domain\Base\Statuses\Resources\StatusResource;
use DDD\App\Controllers\Controller;

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
