<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user')->paginate(5);

        return view('order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all(['id', 'product_name', 'stock']);
        return view('order.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $product = Product::find($request->name);

        if ($request->quantity > $product->stock) {
            return back()->withErrors("Quantity melebihi stock product");
        }

        $order->product_id = $product->id;
        $order->quantity = $request->quantity;
        $order->price = $request->quantity * $product->price;
        $order->order_date = Carbon::createFromFormat('d/m/Y', $request->order_date)->toDateTimeString(); // '22/02/2020'

        $order->created_by = Auth::id();

        $order->save();

        $product->stock = $product->stock - $order->quantity;

        $product->save();

        $message = 'Order data "'.$order->id. '" added successfully!';

        return redirect()->route('order.index')->with('message', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $products = Product::all(['id', 'product_name', 'stock']);
        return view('order.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderRequest $request, Order $order)
    {
        $product = Product::find($request->name);

        $change_in_quantity = false;
        if ($request->quantity != $order->quantity) {
            $change_in_quantity = true;

            $diff = $request->quantity - $order->quantity;
            $product->stock = $product->stock - $diff;
        }

        if ($change_in_quantity && $request->quantity > $product->stock) {
            return back()->withErrors("Quantity melebihi stock product");
        }

        $order->product_id = $product->id ?? $order->product_id;
        $order->quantity = $request->quantity ?? $order->quantity;
        $order->price = $order->quantity ? ($order->quantity * $product->price) : $order->price;
        $order->order_date = $request->order_date ? Carbon::createFromFormat('d/m/Y', $request->order_date)->toDateTimeString() : $order->order_date;

        $order->save();

        if ($change_in_quantity) {
            $product->save();
        }

        $message = 'Order data "'.$order->id. '" updated successfully!';

        return redirect()->route('order.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $temp = $order->id;

        $order->delete();

        $message = 'Order data "'.$temp. '" deleted successfully!';

        return redirect()->route('order.index')->with('message', $message);
    }
}
