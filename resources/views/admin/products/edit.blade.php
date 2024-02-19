@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <p style="color:red">
                @if($errors->any())
                {{ $errors->first() }}
                @endif
            </p>
            <!-- Biểu mẫu chỉnh sửa sản phẩm -->
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Trong edit.blade.php -->

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="text" name="price" class="form-control" value="{{ $product->price }}">
                </div>

                <!-- Hiển thị hình ảnh sản phẩm -->
                @if ($productImages->count() > 0)
                    <div class="form-group">
                        <label for="images">Hình ảnh sản phẩm</label>
                        <div class="row">
                            @foreach ($productImages as $image)
                                <div class="col-md-3 mb-3">
                                    <img src="{{ asset('storage').'/'.$image->image_path }}" alt="Product Image" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div id="image-inputs">
                    <!-- Các trường hình ảnh sẽ được thêm ở đây -->
                </div>

                <button type="button" class="btn btn-primary" onclick="addImageInput()">Thêm Hình Ảnh</button>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
    <script>
        function addImageInput() {
            var inputHtml = `
                <div class="form-group">
                    <label for="images">Hình ảnh sản phẩm</label>
                    <input type="file" name="images[]" class="form-control-file">
                </div>
            `;
            document.getElementById('image-inputs').insertAdjacentHTML('beforeend', inputHtml);
        }
    </script>
@endsection
