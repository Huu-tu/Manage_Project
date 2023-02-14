<?php

use App\Http\Controllers\ApiKeyAdminController;
use App\Http\Controllers\ApiKeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\FileUploadController;
use App\Models\ApiKeyAdmin;

//Main Page
Route::get('/',[PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);

//Auth
Route::get('/login', [AuthController::class, 'login']);
Route::post('/postLogin',[AuthController::class, 'postLogin']);
Route::get('/registration', [AuthController::class, 'register']);
Route::post('/postRegistration', [AuthController::class, 'postRegister']);
Route::get('/logout', [AuthController::class, 'logOut']);

//Route::get('product',[
//    ProductController::class,
//    'index'
//]);

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

Route::get('/getFileUploadToDrive',[GoogleDriveController::class,'getFileUploadToDrive']);

//Route::get('/google/login',[GoogleDriveController::class,'googleLogin'])->name('google.login');
//Route::get('/uploadFIle',[GoogleDriveController::class,'uploadFile']);
//Route::post('/google-drive/file-upload',[GoogleDriveController::class,'googleDriveFilePpload'])->name('google.drive.file.upload');
//Route::post('/fileUploadToDrive',[GoogleDriveController::class,'fileUploadToDrive']);

//Route::group(['middleware' => ['web', 'auth']], function(){
//    Route::get('dropbox', function(){
//
//        if (! Dropbox::isConnected()) {
//            return redirect(env('DROPBOX_OAUTH_URL'));
//        } else {
//            //display your details
//            return Dropbox::post('users/get_current_account');
//        }
//
//    });
//
//    Route::get('dropbox/connect', function(){
//        return Dropbox::connect();
//    });
//
//    Route::get('dropbox/disconnect', function(){
//        return Dropbox::disconnect('app/dropbox');
//    });
//});


//Cloud
Route::get('/google/login',[GoogleDriveController::class,'googleLogin'])->name('google.login');

Route::get('product',[
    ProductController::class,
    'index'
]);

Route::post('/createApiKey', [ApiKeyController::class, 'createApiKey']);

Route::post('/createApiKeyAdmin', [ApiKeyAdminController::class, 'createApiKey']);

Route::group(['middleware' =>['ApiKeyPrivate']], function () {
    Route::get('/getApiKeyAdmin', [ApiKeyAdminController::class, 'index']);
});

Route::group(['middleware' =>['PublicApiKey']], function () {
    Route::get('/getApiKey', [ApiKeyController::class, 'index']);
});

Route::get('/getFileUpload/{option}/{key}',[FileUploadController::class,'getFileUpload']);
Route::get('/getAllFileUploadCloud/{option}',[FileUploadController::class,'getAllFileUploadCloud']);
Route::post('/fileUploadToCloud/{option}',[FileUploadController::class,'fileUploadToCloud']);
Route::delete('/fileDeleteCloud/{option}/{id}',[FileUploadController::class,'fileDeleteCloud']);
Route::get('/fileDownLoadCloud',[FileUploadController::class,'fileDownLoadCloud']);

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



