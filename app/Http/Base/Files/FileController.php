<?php

namespace DDD\Http\Base\Files;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Vendors
use Spatie\QueryBuilder\QueryBuilder;

// Models
use DDD\Domain\Base\Organizations\Organization;
use DDD\Domain\Base\Files\File;

// Requests
use DDD\Domain\Base\Files\Requests\StoreFileRequest;

// Resources
use DDD\Domain\Base\Files\Resources\FileResource;

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
        // $path = $request->file('file')->store($organization->slug, 's3');

        // $file = $organization->files()->create([
        //     'path' => $path,
        //     'name' => pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME),
        //     'filename' => basename($path),
        //     'extension' => $request->file->extension(),
        //     'mime' => $request->file->getMimeType(),
        // ]);

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

    public function destroy(Organization $organization, File $file)
    {
        $file->delete();

        return response()->json(['message' => 'File destroyed'], 200);
    }
}
