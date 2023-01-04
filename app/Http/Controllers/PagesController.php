<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function index(){
        $products = Product::all();

        return view('index', ['products' => $products]);
    }
    public function news(){
        return view('news.news');
    }
    public function about(){
        return view('about');
    }
}
