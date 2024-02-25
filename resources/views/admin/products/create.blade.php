@extends('admin.layouts.app')
@section('content')
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Tạo mới sản phẩm</a>
        </div>
    </nav>

    <div class="card">
        <div class="card-body">
            <!-- Biểu mẫu chỉnh sửa sản phẩm -->
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="category_id">Danh mục</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Select danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" id="image" name="image" class="form-control">
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" id="name" name="name" class="form-control">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" id="price" name="price" class="form-control">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="discount_price">Giá sale</label>
                    <input type="text" id="discount_price" name="discount_price" class="form-control">
                    @error('discount_price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="spec">Thông số kỹ thuật</label>
                    <select class="form-control" name="spec" id="spec">
                        <option value="">Select thông số kỹ thuật</option>
                        @foreach ($technical_specs as $technical_spec)
                            <option value="{{ $technical_spec->id }}">{{ $technical_spec->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="warranty">Chính sách bảo hành</label>
                    <select class="form-control" name="warranty" id="warranty">
                        <option value="">Select chính sách bảo hành</option>
                        @foreach ($warranties as $warranty)
                            <option value="{{ $warranty->id }}">{{ $warranty->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="promotion">Khuyến mãi/ưu đãi</label>
                    <select class="form-control" name="promotion" id="promotion">
                        <option value="">Select khuyến mãi/ưu đãi</option>
                        @foreach ($promotions as $promotion)
                            <option value="{{ $promotion->id }}">{{ $promotion->title }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Tạo mới</button>
            </form>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-header">
            <h2>Thêm thông số kỹ thuật của sản phẩm</h2>
        </div>

        <div class="card-body">
            <!-- Biểu mẫu chỉnh sửa danh mục -->
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id">
                <div id="specContainer">

                </div>
                <button type="button" class="btn btn-sm btn-secondary" id="addSpecButton">Thêm 1 thông số
                    kỹ thuật</button>
                <button type="submit" class="btn btn-sm btn-primary">Lưu thông số kỹ thuật</button>
            </form>
        </div>
    </div> --}}

    {{-- <script>
        $(document).ready(function() {
            var specCount = 0;
            $('#addSpecButton').click(function(e) {
                console.log(1111111);
                e.preventDefault();
                specCount++;

                var newSpec = `
                <div class="form-group">
                    <h5>Thông số kỹ thuật ${specCount}</h3>
                    <div class="form-group">
                        <label for="name_${specCount}">Tên thông số</label>
                        <input type="text" id="name_${specCount}" name="specs[${specCount}][name]" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="value_${specCount}">Giá trị</label>
                        <input type="text" id="value_${specCount}" name="specs[${specCount}][value]" class="form-control">
                    </div>
                </div>
                `;

                $('#specContainer').append(newSpec);
            });
        });
    </script> --}}
@endsection
