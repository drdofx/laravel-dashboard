<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::with('user')->orderByDesc('purchase_date')->paginate(10);

        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all(['id', 'product_name', 'stock']);
        $suppliers = Supplier::all(['id', 'supplier_name']);
        return view('purchase.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        $purchase = new Purchase();
        $product = Product::find($request->product);

        $purchase->product_id = $product->id;
        $purchase->supplier_id = $request->supplier;
        $purchase->quantity = $request->quantity;
//        $purchase->total_price = $request->quantity * $product->price * 0.8;
        $purchase->total_price = $request->price;
        $purchase->purchase_date = Carbon::createFromFormat('d/m/Y', $request->purchase_date)->toDateTimeString();

        $purchase->created_by = Auth::id();

        $purchase->save();

        $product->stock = $product->stock + $purchase->quantity;

        $product->save();

        $message = 'Purchase data "'.$purchase->id. '" added successfully!';

        return redirect()->route('purchase.index')->with('message', $message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $products = Product::all(['id', 'product_name', 'stock']);
        $suppliers = Supplier::all(['id', 'supplier_name']);
        return view('purchase.edit', compact('purchase', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(StorePurchaseRequest $request, Purchase $purchase)
    {
        $product = Product::find($purchase->product_id);

        $change_in_quantity = false;
        $change_in_product = false;

        if ($request->product != $purchase->product_id) {
            $change_in_product = true;

            $new_product = Product::find($request->product);

            $product->stock = $product->stock - $purchase->quantity;
            $new_product->stock = $new_product->stock + $request->quantity;

            $product->save();
            $new_product->save();

            $purchase->product_id = $request->product;
        }

        if (!$change_in_product && $request->quantity != $purchase->quantity) {
            $change_in_quantity = true;

            $diff = $request->quantity - $purchase->quantity;
            $product->stock = $product->stock + $diff;
        }

        $purchase->supplier_id = $request->supplier ?? $purchase->supplier;
        $purchase->quantity = $request->quantity ?? $purchase->quantity;
//        $purchase->total_price = $change_in_product ? ($purchase->quantity * $new_product->price * 0.8) : ($purchase->quantity * $product->price * 0.8);
        $purchase->total_price = $request->price ?? $purchase->total_price;
        $purchase->purchase_date = $request->purchase_date ? Carbon::createFromFormat('d/m/Y', $request->purchase_date)->toDateTimeString() : $purchase->purchase_date;

        $purchase->save();

        if ($change_in_quantity) {
            $product->save();
        }

        $message = 'Purchase data "'.$purchase->id. '" updated successfully!';

        return redirect()->route('purchase.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $temp = $purchase->id;

        $product = Product::find($purchase->product_id);
        $product->stock = $product->stock - $purchase->quantity;

        $purchase->delete();

        $product->save();

        $message = 'Purchase data "'.$temp. '" deleted successfully!';

        return redirect()->route('purchase.index')->with('message', $message);
    }
}
