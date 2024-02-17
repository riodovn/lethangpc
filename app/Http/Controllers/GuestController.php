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
        $products = Product::where('status','selling')->orderBy('id','DESC')->take(5)->get();
        return view('trang-chu',compact('products'));
    }
}
