<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\Products;
use App\Models\OrderItem;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $start = gmdate('Y-m-d 00:00:00', strtotime($request->start));
        // $end = gmdate('Y-m-d 23:59:59', strtotime($request->end));
        $d = mktime(00, 00, 00, 0, 00, 0000);
        $start = $request->start ? $request->start : date('Y-m-d', $d);
        $end = $request->end ? $request->end : date('Y-m-d');
        $distr = $request->distr ? $request->distr : '*';

        $orders = Order::with(['purchaser'])->whereBetween('order_date', [$start, $end]);
        // if($request->dist) $orders->join('users', 'users.ius')
        // dd($start, $end);
        return view('orders', [

            'orders'    =>  $orders->paginate(10),
        ]);
    }
}
