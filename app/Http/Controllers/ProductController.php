<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Products;
use App\Models\OrderItem;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('orders', [
            'orders' => Orders::all(),
            'orderItem' => OrderItem::all(),
            'product' => Products::all(),
            'user' => User::all(),
            'category' => Category::all(),
            'userCategory' => UserCategory::all(),
        ]);
    }
}
