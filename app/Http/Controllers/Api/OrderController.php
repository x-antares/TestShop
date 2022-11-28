<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::with('orderProducts')->paginate(30));
    }

    public function store(OrderRequest $request)
    {
        if(!empty(session()->get('cart'))){
            $order = Order::create([
            'first_name' => $request->first_name,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

            foreach (session()->get('cart') as $product) {
                OrderProduct::create([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                ]);
            }
            session()->forget('cart');
        }else{
            return response()->json([
                'message'   =>  'empty cart'
            ]);
        }

        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        if(Gate::allows('auth-only')) {

            $order->update($request->only([
                'first_name',
                'city',
                'phone',
            ]));

            return new OrderResource($order);
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }

    public function destroy(Order $order)
    {
        if(Gate::allows('auth-only')) {
            $order->delete();

            return response()->noContent();
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
