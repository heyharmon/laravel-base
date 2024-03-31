<?php

namespace DDD\Http\Base\Categories;

use Illuminate\Http\Request;
use DDD\Domain\Base\Categories\Resources\CategoryResource;
use DDD\Domain\Base\Categories\Category;
use DDD\App\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::parents()->latest()->get();

        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        $category = $category->descendantsAndSelf()->get()->toTree();

        return new CategoryResource($category->first());
    }

    public function update(Category $category, Request $request)
    {
        $category->update($request->all());

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return new CategoryResource($category);
    }
}
