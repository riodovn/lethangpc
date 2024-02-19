<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WarrantyPolicy;

class WarrantyPolicyController extends Controller
{
    public function index()
    {
        $policies = WarrantyPolicy::all();

        return view('admin.warranty_policies.index', compact('policies'));
    }

    /**
     * Tạo mới chính sách bảo hành
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.warranty_policies.create');
    }

    /**
     * Lưu trữ chính sách bảo hành
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $policy = WarrantyPolicy::create($request->all());

        return redirect()->route('admin.warranty_policies.index')
            ->with('success', 'Chính sách bảo hành đã được tạo thành công!');
    }

    /**
     * Hiển thị chi tiết chính sách bảo hành
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $policy = WarrantyPolicy::findOrFail($id);

        return view('admin.warranty_policies.show', compact('policy'));
    }

    /**
     * Chỉnh sửa chính sách bảo hành
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $policy = WarrantyPolicy::findOrFail($id);

        return view('admin.warranty_policies.edit', compact('policy'));
    }

    /**
     * Cập nhật chính sách bảo hành
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $policy = WarrantyPolicy::findOrFail($id);

        $policy->update($request->all());

        return redirect()->route('admin.warranty_policies.index')
            ->with('success', 'Chính sách bảo hành đã được cập nhật thành công!');
    }

    /**
     * Xóa chính sách bảo hành
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $policy = WarrantyPolicy::findOrFail($id);

        $policy->delete();

        return redirect()->route('admin.warranty_policies.index')
            ->with('success', 'Chính sách bảo hành đã được xóa thành công!');
    }
    
}
