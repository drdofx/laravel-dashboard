<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::user()->admin;

        if ($admin) {
            $users = User::where('admin', 0)->count();
            return view('dashboard.index', compact('users'));
        }

        $suppliers = Supplier::all()->count();
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $purchases = Purchase::all()->count();

        return view('dashboard.index', compact('suppliers', 'products', 'orders', 'purchases'));
    }
}
