<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function categoriesList()
    {
        return view('admin.categories');
    }

    public function usersList()
    {
        return view('admin.danh-sach-nguoi-dung');
    }
    
    public function technicalSpecificationsList()
    {
        return view('admin.danh-sach-thong-so-ky-thuat');
    }
}
