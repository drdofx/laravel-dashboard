<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $products = Product::where('product_name', 'LIKE','%'.$request->search.'%')->with('user')->paginate(5);
        } else {
            $products = Product::with('user')->paginate(5);
        }

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->product_name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;

        if ($request->file('image')) {
            $path = Storage::disk('public')->putFileAs('images', $request->file('image'), Carbon::now()->timestamp . "_" . $request->file('image')->getClientOriginalName());
        } else {
            $path = null;
        }

        $product->file_name = $path ?? "-";

        $product->created_by = Auth::id();

        $product->save();

        $message = 'Product data "'.$product->product_name. '" added successfully!';

        return redirect()->route('product.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->product_name = $request->name ?? $product->product_name;
        $product->stock = $request->stock ??  $product->stock;
        $product->price = $request->price ?? $product->price;

        if ($request->file('image')) {
            $old_path = $product->file_name;

            $path = Storage::disk('public')->putFileAs('images', $request->file('image'), Carbon::now()->timestamp . "_" . $request->file('image')->getClientOriginalName());

            if (Storage::disk('public')->exists($old_path)) {
                Storage::disk('public')->delete($old_path);
            }
        } else {
            if ($request->delete_image) {
                $old_path = $product->file_name;

                $product->file_name = "-";

                if (Storage::disk('public')->exists($old_path)) {
                    Storage::disk('public')->delete($old_path);
                }
            }

            $path = null;
        }

        $product->file_name = $path ?? $product->file_name;

        $product->save();

        $message = 'Product data "'.$product->product_name. '" updated successfully!';

        return redirect()->route('product.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $temp = $product->product_name;

        $product->delete();

        $message = 'Product data "'.$temp. '" deleted successfully!';

        return redirect()->route('product.index')->with('message', $message);
    }
}
