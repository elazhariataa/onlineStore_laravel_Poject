<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\OnlineStoreMail;


class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('adminSpace.adminDashboard');
    }


/* Category functions */
    public function displayCategories(){
        $categories=Category::get();
        return view('adminSpace.categories',compact('categories'));
    }

    /* add a category */
    public function addCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:255|unique:categories'
        ]);

        $category = new Category;
        $category->name=$validatedData['name'];
        $category->save();

        return back()->with('success', 'Category added successfully!');
    }
    /* updated category */
    public function updatedCategory(Category $category)
    {
        return view('adminSpace.updatedCategory',compact('category'));
    }

    public function EditeCategory(Request $request,Category $category)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:255|unique:categories'
        ]);

        $category->name=$validatedData['name'];
        $category->save();

        return redirect('/adminDashboard/displayCategories');
    }
    /* delete category */
    public function deleteCategory(Category $category)
    {
        $category->delete();

        return redirect('/adminDashboard/displayCategories');
    }

/* product functions */
    /* display products */
    public function displayProducts()
    {
        $products = Product::get();
        $categories = Category::get();
        return view('adminSpace.products',compact('products'));
    }


    /* add product */
    public function createProduct()
    {
        $categories=Category::get();
        return view('adminSpace.createProduct', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name'=> 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('public/images');

        $product = new Product;
        $product->name=$validatedData['name'];
        $product->description=$validatedData['description'];
        $product->price=$validatedData['price'];
        $product->category_id=$validatedData['category_id'];
        $product->gender=$validatedData['gender'];
        $product->image = $imagePath;
        $product->save();

        return redirect('/adminDashboard/displayProducts');
    }

    /* update Product */
    public function updateProduct(Product $product)
    {
        $categories=Category::get();
        return view('adminSpace.updateProduct',compact('product','categories'));
    }

    public function editeProduct(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name'=> 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'gender' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($product->image);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        } else {
            $imagePath = $product->image;
        }

        $product->name=$validatedData['name'];
        $product->description=$validatedData['description'];
        $product->price=$validatedData['price'];
        $product->category_id=$validatedData['category_id'];
        $product->gender=$validatedData['gender'];
        $product->image = $imagePath;
        $product->save();

        
        return redirect('/adminDashboard/displayProducts');
    }

    /* delete Product */
    public function deleteProduct(Product $product)
    {
        $product->delete();
        Storage::delete($product->image);

        return redirect('/adminDashboard/displayProducts');
    }


/* Order functions */

    //display orders
    public function displayOrders()
    {
        $orders = Order::get();
        return view('adminSpace.displayOrders',compact('orders'));
    }

    //change order state
    public function changeOrderState(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $order->state = $request->state;
        $order->save();

        // send email to user
        $user = $order->user;
        $mailData = ['state' => $order->state];
        Mail::to($user->email)->send(new OnlineStoreMail($mailData));

        return redirect()->back()->with('success', 'Order state updated successfully.');
    }

/* displayClients */
    //clients list
    public function displayClients()
    {
        $clients = User::where('is_admin',0)->get();
        return view('adminSpace.clientsList',compact('clients'));
    }

    //change account state
    public function changeAccountState(Request $request, $clientId)
    {
        $client = User::findOrFail($clientId);

        $client->is_blocked = (! $request->is_blocked);
        $client->save();

        return redirect()->back()->with('success', 'Account state updated successfully.');
    }

    //delete client
    public function deleteClient($clientId)
    {
        $client = User::findOrFail($clientId);
        $client->delete();

        return redirect()->back()->with('success', 'client deleted successfully.');
    }

    //export products
    public function export() 
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    //import products
    public function import() 
    {
        Excel::import(new ProductImport,request()->file('file'));
               
        return back();
    }
}
