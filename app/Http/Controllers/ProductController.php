<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
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
