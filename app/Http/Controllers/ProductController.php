<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\ProductPromotion;
use App\Models\ProductTechnicalSpec;
use App\Models\ProductWarrantyPolicy;
use App\Models\Promotion;
use App\Models\TechnicalSpec;
use App\Models\WarrantyPolicy;
use Intervention\Image\ImageManagerStatic as Image_Tool;
use Promotions;
use Maatwebsite\Excel\Facades\Excel;

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
        $technical_specs = TechnicalSpec::all();
        $categories = Category::all();
        $warranties = WarrantyPolicy::all();
        $promotions = Promotion::all();
        return view('admin.products.create', compact('technical_specs', 'categories', 'warranties', 'promotions'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'category_id' => 'required',
            'image' => 'required|mimes:jpeg, png, jpg, gif',
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'price' =>'required|numeric',
            'discount_price' =>'required|numeric',
        ], [
            'category_id.required' => 'Danh mục sản phẩm không được để trống',
            'image.required' => 'Hình ảnh sản phẩm không được để trống',
            'image.mimes' => 'File không hợp lệ',
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.string' => 'Tên sản phẩm phải là chuỗi',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Giá sản phẩm không được để trống',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'discount_price.required' => 'Giá giảm giá không được để trống',
            'discount_price.numeric' => 'Giá giảm giá phải là số',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category_id;

        $product->save();

        if($request->hasFile('image')){
            //dd(1);

            $imageFile = $request->file('image');

            // Reseze ảnh về tỉ lệ 1:1
            $image = Image_Tool::make($imageFile)->fit(1024, 1024, function($constraint){
                $constraint->upsize();
            });

            // Tạo tên file duy nhất có thêm thời gian
            $imageName = time() . '_' . $imageFile->getClientOriginalName();
            $imagePath = 'image/products/' . $imageName;

            // Lưu hình ảnh vào thư mục public/image/products
            $image->save(public_path($imagePath));

            // Lưu thông tin ảnh vào bảng product_images
            $productImage = new ProductImage();
            $productImage->image_path = $imagePath;
            $productImage->product_id = $product->id;
            $productImage->save();
        }

        if($request->spec != null){
            $product_spec = new ProductTechnicalSpec();
            $product_spec->product_id = $product->id;
            $product_spec->technical_specification_id = $request->spec;
            $product_spec->save();
        }

        if($request->warranty != null){
            $product_warranty = new ProductWarrantyPolicy();
            $product_warranty->product_id = $product->id;
            $product_warranty->warranty_policy_id = $request->warranty;
            $product_warranty->save();
        }

        if($request->promotion != null){
            $product_promotion = new ProductPromotion();
            $product_promotion->product_id = $product->id;
            $product_promotion->promotion_id = $request->promotion;
            $product_promotion->save();
        }

        session()->flash('success', 'Tạo mới sản phẩm thành công!!');
        return redirect()->route('admin.products.index');
    }
    public function edit(Product $product)
    {
        $productImages = ProductImage::where('product_id', $product->id)->get();

        //dd($product);

        $product_specs = $product->technicalSpecs;

        $product_warranty_policies = $product->warrantyPolicies;

        $product_promotions = $product->promotions;
        
        //dd($product_specs);

        return view('admin.products.edit', compact('product', 'productImages', 'product_specs', 'product_warranty_policies', 'product_promotions'));
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

    // Thêm các thông số kỹ thuật gắn vào sản phẩm
    public function addSpec(Request $request){
        //dd($request->all());

        $product = Product::findOrFail($request->product_id);
        $specs = $request->input('specs');

        // Duyệt qua những thông số kỹ thuật
        foreach ($specs as $specKey => $specData) {
            $technical_spec = new TechnicalSpec();
            $technical_spec->name = $specData['name'];
            $technical_spec->value = $specData['value'];
            $technical_spec->save();

            $product_spec = new ProductTechnicalSpec();
            $product_spec->product_id = $product->id;
            $product_spec->technical_specification_id = $technical_spec->id;
            $product_spec->save();
        }

        session()->flash('success', 'Tạo mới thông số kỹ thuật thành công!!');
        return redirect()->back();
    }

    public function deleteSpec($id){
        $spec = TechnicalSpec::findOrFail($id);

        $spec->delete();

        session()->flash('success', 'Xoá thông số kỹ thuật thành công!!');
        return redirect()->back();
    }

    // Thêm các chính sách bảo hành cho sản phẩm
    public function addWarranty(Request $request){
        $product = Product::findOrFail($request->product_id);
        $warranties = $request->input('warranties');

        // Duyệt qua những thông số kỹ thuật
        foreach ($warranties as $warrantyKey => $warrantyData) {
            $warranty_policy = new WarrantyPolicy();
            $warranty_policy->title = $warrantyData['title'];
            $warranty_policy->content = $warrantyData['content'];
            $warranty_policy->save();

            $product_spec = new ProductWarrantyPolicy();
            $product_spec->product_id = $product->id;
            $product_spec->warranty_policy_id = $warranty_policy->id;
            $product_spec->save();
        }

        session()->flash('success', 'Tạo mới chính sách bảo hành thành công!!');
        return redirect()->back();
    }

    public function deleteWarranty($id){
        $warranty = WarrantyPolicy::findOrFail($id);

        $warranty->delete();

        session()->flash('success', 'Xoá chính sách bảo hành thành công!!');
        return redirect()->back();
    }

    // Thêm các khuyến mãi/ưu đãi cho sản phẩm
    public function addPromotion(Request $request){
        $product = Product::findOrFail($request->product_id);
        $promotions = $request->input('promotions');

        // Duyệt qua những khuyến mãi/ưu đãi
        foreach ($promotions as $promotionKey => $promotionData) {
            $promotion = new Promotion();
            $promotion->title = $promotionData['title'];
            $promotion->description = $promotionData['description'];
            $promotion->save();

            $product_promotion = new ProductPromotion();
            $product_promotion->product_id = $product->id;
            $product_promotion->promotion_id = $promotion->id;
            $product_promotion->save();
        }

        session()->flash('success', 'Tạo mới khuyến mãi/ưu đãi thành công!!');
        return redirect()->back();
    }

    public function deletePromotion($id){
        $promotion = Promotion::findOrFail($id);

        $promotion->delete();

        session()->flash('success', 'Xoá khuyến mãi/ưu đãi thành công!!');
        return redirect()->back();
    }

    // Import products từ file Excel
    public function importProducts(){
        return view('admin.products.import-products');
    }

    public function uploadProducts(Request $request){
        $file = $request->file('file');

        //dd($file);
        Excel::import(new ProductsImport, $file);
        
        return redirect()->route('admin.products.index')->with('success', 'Đã nhập sản phẩm hàng loạt từ file excel thành công!');
    }
}
