<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;

class HomeController extends Controller
{
// product functions
    public function index(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $category = $request->input('category_id');
        $gender = $request->input('gender');

        $query = Product::query();

        if($name){
            $query->where('name', 'like', '%'.$name.'%');
        }

        if($price){
            $query->where('price', '<=', $price);
        }

        if($category){
            $query->where('category_id', "=", $category);
        }

        if($gender){
            $query->where('gender', "=", $gender);
        }

        $products = $query->get();
        $categories = Category::get();
        
        return view('home',compact('products','categories'));
    }
// blocked user
    public function blockPage()
    {
        return view('blockPage');
    }
    
    public function productDetails(Product $product)
    {
        return view('product.productDetails',compact('product'));
    }

//cart functions

    //display cart
    public function displayCart()
    {
        $cartItems = session('cart.items', []);
        $total =0;
        foreach($cartItems as $cartItem){
            $total += $cartItem['quantity'] * $cartItem['product']->price;
        }
        return view('cart',compact('cartItems','total'));
    }

    //add to cart
    public function addToCart(Request $request,$productId)
    {
        //check product in the database
        $product = Product::findOrFail($productId);

        //get cart products
        $cartItems = session()->get('cart.items',[]);

        //check product in the cart
        if(array_key_exists($productId, $cartItems)){
            $cartItems[$productId]['quantity']++;
        }else{
            $cartItems[$productId]=[
                'product' => $product,
                'quantity' =>1
            ];
        }
        session()->put('cart.items', $cartItems);

        return back()->with('success', 'Product added to cart.');
    }

    //quantity increase/decrease
    public function increaseQuantity($productId)
    {
        $cartItems = session('cart.items',[]);

        if(array_key_exists($productId, $cartItems)){
            $cartItems[$productId]['quantity']++;

            session(['cart.items' => $cartItems]);
        }
        
        return redirect()->route('displayCart');
    }

    public function decreaseQuantity($productId)
    {
        $cartItems = session('cart.items',[]);

        if(array_key_exists($productId, $cartItems)){
            $cartItems[$productId]['quantity']--;

            if ($cartItems[$productId]['quantity'] <= 0) {
                unset($cartItems[$productId]);
            }

            session(['cart.items' => $cartItems]);
        }

        return back()->with('success', 'item decreased.');
    }

    //delete cart item
    public function deleteCartItem($productId)
    {
        $cartItems = session('cart.items', []);
        if (isset($cartItems[$productId])) {
            unset($cartItems[$productId]);
            session(['cart.items' => $cartItems]);
        }
        return redirect()->route('displayCart');
    }

// order routes
    
    //add an order
    public function addOrder(Request $request)
    {
        //check if user is authenticated
        if(!auth()->check()){
            return redirect()->route('login.form')->with('redirectBack', true);
        }

        $cartItems = session('cart.items',[]);
        $total =0;
        foreach($cartItems as $cartItem){
            $total += $cartItem['quantity'] * $cartItem['product']->price;
        }

        //create order
        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->state = "Pending";
        $order->save();

        //create order_item
        foreach($cartItems as $productId => $item){
            $orderItem = new Order_item;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $productId;
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['quantity'] * $item['product']->price;
            $orderItem->save();
        }

        session()->forget('cart.items');

        return redirect()->route('home')->with('success', 'Your order has been placed.');
    }

    //contact us
    public function contactForm()
    {
        return view('contactUs');
    }
}
