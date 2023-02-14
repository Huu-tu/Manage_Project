<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use App\Models\User;

class ProductController extends Controller
{
    public function index(Request $request, Schedule $schedule) {
//        $products = Product::all();
//
//        return view('products.index', ['products' => "{$products}"]);

        // $value =$request->header('Apikey');
        // $content = Hash::check("plain-text","{$value}");

        $schedule->call(function(){
            // return response()->json("thanh cong");
            User::create([
                "name" => Str::random(12),
                "email" => Str::random(12),
                "password" => "tuhuuu",
            ]);    
        })->everyMinute();
//        dd($request->header('Apikey'));
//        return response()->json('Thanh cong');
    }
    
    public function about(){
        return 'This is a Page';
    }

    public function createProduct(){
        return view('products.createProduct');
    }

    public function storeProduct(){

        request() ->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Product::create([
            'title' => request('title'),
            'description' => request('description')
        ]);

        return redirect('/');
    }

    public function updateProduct(Product $product){
        return view('products.updateProduct', ['product' =>$product]);
    }

    public function editProduct(Product $product){
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $product->update([
            'title' => request('title'),
            'description' => request('description'),
        ]);

        return redirect('/');
    }

    public function deleteProduct(Product $product){
        $product->delete();

//        $product = Product::find(id)->delete();
        return redirect('/');
    }

}
