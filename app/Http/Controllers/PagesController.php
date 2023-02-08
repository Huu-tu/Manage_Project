<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function index(){

        return view('index');
    }
    public function news(){
        return view('news.news');
    }
    public function about(){
        return view('about');
    }
}
