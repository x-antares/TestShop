<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;


class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate(20));
    }

    public function store(CategoryRequest $request)
    {
        if(Gate::allows('auth-only')) {
            $request->merge([
                'slug' => str_slug($request->name, '-'),
            ]);

            $product = Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);

            return new CategoryResource($product);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if(Gate::allows('auth-only')) {
            $request->merge([
                'slug' => str_slug($request->name, '-'),
            ]);

            $category->update($request->only(['name', 'slug']));

            return new CategoryResource($category);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function destroy(Category $category)
    {
        if(Gate::allows('auth-only')) {

            $category->products()->detach();
            $category->delete();

            return response()->noContent();
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
