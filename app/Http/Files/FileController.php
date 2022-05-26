<?php

namespace DDD\Http\Files;

use Illuminate\Http\Request;
use DDD\App\Controllers\Controller;

// Vendors
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

// Domains
use DDD\Domain\Files\File;

class FileController extends Controller
{
    public function index()
    {
        $files = QueryBuilder::for(File::class)
            ->allowedFilters(['type', 'group'])
            ->latest()
            ->get();

        return response()->json($files);
    }

    public function store(Request $request)
    {
        $file = File::create($request->all());

        return response()->json($file);
    }
}
