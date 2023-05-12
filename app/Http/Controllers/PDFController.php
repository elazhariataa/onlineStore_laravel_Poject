<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = $order->user;
        $items = $order->items;
  
        $data = [
            'title' => 'Your order details',
            'date' => date('m/d/Y'),
            'order' => $order,
            'user' => $user,
            'items' => $items
        ]; 
            
        $pdf = PDF::loadView('myPDF', $data);
     
        return $pdf->download('OnlineShop.pdf');
    }
}
