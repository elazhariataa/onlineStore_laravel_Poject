<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Order_item;

class clientController extends Controller
{
    public function clientDashboard()
    {
        return view('clientSpace.helloPage');
    }

    //order List
    public function orderList()
    {
        $user = auth()->user()->id;
        $orders = Order::where('user_id', $user)->get();
        return view('clientSpace.orderList',compact('orders'));
    }

    //order Details
    public function orderDetails(Order $order)
    {
        $orderId = $order->id;
        $orderItems = Order_item::where('order_id',$orderId)->get();
        return view('clientSpace.orderDetails',compact('orderItems'));
    }
}
