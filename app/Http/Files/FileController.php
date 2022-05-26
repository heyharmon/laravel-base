<?php

namespace DDD\Http\Files;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Vendors
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

// Domains
use DDD\Domain\Files\File;
use DDD\Domain\Organizations\Organization;

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
        // $file = File::create($request->all());
        $file = $organization->files()->create($request->all());

        return response()->json($file);
    }
}
