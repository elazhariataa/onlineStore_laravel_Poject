<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->name('home');

/* contact us */
Route::get('/contactUs',[HomeController::class, 'contactForm'])->name('contactForm');

/* product routes */
Route::get('/product/details/{product}',[HomeController::class, 'productDetails'])->name('productDetails');

Route::post('/order/addOrder',[HomeController::class, 'addOrder'])->name('addOrder');

/* cart routes */
Route::post('/product/addToCart/{productId}',[HomeController::class, 'addToCart'])->name('addToCart');
Route::get('/product/displayCart',[HomeController::class, 'displayCart'])->name('displayCart');
Route::post('/product/cart/increaseQuantity/{productId}',[HomeController::class, 'increaseQuantity'])->name('increaseQuantity');
Route::post('/product/cart/decreaseQuantity/{productId}',[HomeController::class, 'decreaseQuantity'])->name('decreaseQuantity');
Route::delete('/product/cart/deleteCartItem/{productId}',[HomeController::class, 'deleteCartItem'])->name('deleteCartItem');



Route::group(['middleware'=>['guest']],function(){
    /* register routes */
    Route::get('/register',[RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register',[RegisterController::class, 'register'])->name('register.perform');

    /* Login routes */
    Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login',[LoginController::class, 'login'])->name('login.perform');

});

Route::group(['middleware'=>['auth']], function(){
    /* Logout routes */
    Route::get('/logout',[LogoutController::class, 'logout'])->name('logout.perform');
    Route::get('/blockedUser',[HomeController::class, 'blockPage'])->name('blockPage');

    Route::group(['middleware'=>['notBlocked']], function(){
/* client routes */
        Route::get('/clientDashboard',[clientController::class, 'clientDashboard'])->name('clientDashboard');

        /* order route */
        Route::get('/clientDashboard/orderList',[clientController::class, 'orderList'])->name('orderList');
        Route::get('/clientDashboard/orderDetails/{order}',[clientController::class, 'orderDetails'])->name('orderDetails');
        
        Route::get('generate-pdf/{orderId}', [PDFController::class, 'generatePDF'])->name('generatePDF');

    });

    Route::group(['middleware'=>['admin']],function(){
/* admin Routes */
        Route::get('/adminDashboard',[AdminController::class, 'adminDashboard'])->name('adminDashboard');

        /* category routes */
        Route::get('/adminDashboard/displayCategories',[AdminController::class, 'displayCategories'])->name('displayCategories');
        Route::post('adminDashboard/addCategory',[AdminController::class, 'addCategory'])->name('category.add');
        Route::get('adminDashboard/updatedCategory/{category}',[AdminController::class, 'updatedCategory'])->name('updatedCategory');
        Route::put('adminDashboard/EditeCategory/{category}',[AdminController::class, 'EditeCategory'])->name('EditeCategory');
        Route::delete('adminDashboard/deleteCategory/{category}',[AdminController::class, 'deleteCategory'])->name('deleteCategory');

        /* product routes */
        Route::get('/adminDashboard/displayProducts',[AdminController::class, 'displayProducts'])->name('displayProducts');
        Route::get('/adminDashboard/createProduct',[AdminController::class, 'createProduct'])->name('createProduct');
        Route::post('/adminDashboard/addProduct',[AdminController::class, 'addProduct'])->name('addProduct');
        Route::get('/adminDashboard/updateProduct/{product}',[AdminController::class, 'updateProduct'])->name('updateProduct');
        Route::put('/adminDashboard/editeProduct/{product}',[AdminController::class, 'editeProduct'])->name('editeProduct');
        Route::delete('/adminDashboard/deleteProduct/{product}',[AdminController::class, 'deleteProduct'])->name('deleteProduct');
        Route::get('product-export',[AdminController::class, 'export'])->name('product.export');
        Route::post('product-import',[AdminController::class, 'import'])->name('product.import');

        /* gestion client routes */
        Route::get('/adminDashboard/displayClients',[AdminController::class, 'displayClients'])->name('displayClients');
        Route::patch('/adminDashboard/changeAccountState/{clientId}',[AdminController::class, 'changeAccountState'])->name('changeAccountState');
        Route::delete('/adminDashboard/deleteClient/{clientId}',[AdminController::class, 'deleteClient'])->name('deleteClient');
        
        /* order routes */
        Route::get('/adminDashboard/displayOrders',[AdminController::class, 'displayOrders'])->name('displayOrders');
        Route::patch('/adminDashboard/changeState/{orderId}',[AdminController::class, 'changeOrderState'])->name('changeOrderState');
    });




}); 



