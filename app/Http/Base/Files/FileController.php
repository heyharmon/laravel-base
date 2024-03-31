<?php

namespace DDD\Http\Base\Files;

use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\Resources\FileResource;
use DDD\Domain\Base\Files\Requests\StoreFileRequest;
use DDD\Domain\Base\Files\File;
use DDD\App\Controllers\Controller;

class FileController extends Controller
{
    public function index(Organization $organization, Request $request)
    {
        $file = QueryBuilder::for(File::class)
            ->where('organization_id', $organization->id)
            ->latest()
            ->get();

        return FileResource::collection($file);
    }

    public function store(Organization $organization, StoreFileRequest $request)
    {
        $disk = config('filesystems.default');
        $path = $request->file->store($organization->slug, $disk);

        $file = $organization->files()->create([
            'path' => $path,
            'name' => pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME),
            'filename' => basename($path),
            'extension' => $request->file->extension(),
            'mime' => $request->file->getMimeType(),
            'disk' => $disk,
        ]);

        return new FileResource($file);
    }

    public function show(Organization $organization, File $file)
    {
        return new FileResource($file);
    }

    public function destroy(Organization $organization, File $file): JsonResponse
    {
        $file->delete();

        return response()->json(['message' => 'File destroyed'], 200);
    }
}
