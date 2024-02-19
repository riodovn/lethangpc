<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImage;
class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $product = new Product($request->all());
        $product->save();
        return redirect()->route('admin.products.index');
    }
    public function edit(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();
        return view('admin.products.edit', compact('product', 'productImages'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'images.*' => 'image|max:102400', // Kiểm tra định dạng hình ảnh và kích thước
        ]);

        // Cập nhật thông tin cơ bản của sản phẩm
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Nếu có hình ảnh mới được tải lên
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Upload hình ảnh và lưu đường dẫn vào cơ sở dữ liệu
                $imagePath = $image->store('product_images', 'public');

                // Tạo mới bản ghi hình ảnh và liên kết với sản phẩm
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.products.edit', $product->id)->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
