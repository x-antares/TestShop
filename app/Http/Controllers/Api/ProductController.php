<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\CategoryProductsResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Cache::remember('products', 3600, function () {
            return Product::take(50)->orderBy('created_at')->get();
        }));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
        if(Gate::allows('auth-only')){
            $product = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            return new ProductResource($product);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function update(ProductRequest $request, Product $product)
    {
        if(Gate::allows('auth-only')) {
            if (!empty($request->categories)) {
                $product->categories()->detach();
                $product->categories()->attach($request->categories);
            }

            $request->merge([
                'slug' => str_slug($request->name, '-'),
            ]);

            $product->update($request->only([
                'name',
                'slug',
                'description',
                'price',
                'quantity'
            ]));

            return new ProductResource($product);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function destroy(Product $product)
    {
        if(Gate::allows('auth-only')) {

            $product->categories()->detach();
            $product->delete();

            return response()->noContent();
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function categoryProducts($id)
    {
        $category = Category::with('products')->withCount('products')->find($id);

        return new CategoryProductsResource($category);
    }
}
