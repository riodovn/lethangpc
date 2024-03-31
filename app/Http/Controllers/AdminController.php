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

    public function promotionsList()
    {
        return view('admin.danh-sach-khuyen-mai');
    }

    public function bannersList()
    {
        return view('admin.banners');
    }

    public function filesList()
    {
        return view('admin.files');
    }

    public function settingList()
    {
        return view('admin.website-settings');
    }
}
