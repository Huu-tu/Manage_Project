<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleDriveController;

//Main Page
Route::get('/',[PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);

//Auth
Route::get('/login', [AuthController::class, 'login']);
Route::post('/postLogin',[AuthController::class, 'postLogin']);
Route::get('/registration', [AuthController::class, 'register']);
Route::post('/postRegistration', [AuthController::class, 'postRegister']);
Route::get('/logout', [AuthController::class, 'logOut']);

Route::get('product',[
    ProductController::class,
    'index'
]);

Route::get('createProduct',[
    ProductController::class,
    'createProduct'
]);

Route::post('storeProduct',[
    ProductController::class,
    'storeProduct'
]);

Route::get('updateProduct/{id}',[
    ProductController::class,
    'updateProduct'
]);

Route::put('editProduct/{product}',[
    ProductController::class,
    'editProduct'
]);

Route::delete('deleteProduct/{product}',[
    ProductController::class,
    'deleteProduct'
]
);

Route::get('news',[
    NewsController::class,
    'index'
]);

Route::get('profile',[
    ProfileController::class,
    'index'
]);

Route::get('google/login',[GoogleDriveController::class,'googleLogin'])->name('google.login');
Route::get('google-drive/file-upload',[GoogleDriveController::class,'googleDriveFilePpload'])->name('google.drive.file.upload');


Route::group(['middleware' =>['cusTomAuth']], function (){
    Route::get('order', [OrderController::class, 'index']);
    Route::get('createOrder', [OrderController::class, 'createOrder']);
    Route::post('storeOrder', [OrderController::class, 'storeOrder']);
    Route::get('editOrder/{order}', [OrderController::class, 'editOrder']);
    Route::put('updateOrder/{id}', [OrderController::class, 'updateOrder']);
    Route::put('orders/{id}', [OrderController::class, 'updateOrder']);
    Route::delete('deleteOrder/{id}', [OrderController::class, 'deleteOrder']);
    Route::delete('allOrders', [OrderController::class, 'deleteAllOrder']);
});



