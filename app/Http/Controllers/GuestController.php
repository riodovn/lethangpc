<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\WarrantyPolicy;
use App\Models\TechnicalSpec;

use Carbon\Carbon;
use DB;

class GuestController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->take(6)->get();

        $products = Product::where('status','selling')->orderBy('id','DESC')->take(8)->get();

        //dd($products);

        return view('trang-chu',compact('categories', 'products'));
    }

    public function test_home(){
        //dd(1);
        return view('test_home');
    }
}
