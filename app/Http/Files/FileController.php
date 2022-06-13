<?php

namespace DDD\Http\Files;

use DDD\App\Controllers\Controller;
use DDD\Domain\Files\File;
// Vendors
use DDD\Domain\Organizations\Organization;
use Illuminate\Http\Request;
// Domains
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FileController extends Controller
{
    public function index(Organization $organization)
    {
        $files = QueryBuilder::for(File::class)
            ->where('organization_id', $organization->id)
            ->allowedFilters(['type', 'group'])
            ->latest()
            ->get();

        return response()->json($files);
    }

    public function store(Organization $organization, Request $request)
    {
        $file = $organization->files()->create($request->all());

        return response()->json($file);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization, File $file)
    {
        $file->delete();

        // TODO: Use an API Resource to return this
        return response()->json($file);
    }
}
