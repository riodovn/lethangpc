@extends('admin.layouts.app')
@section('content')
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Chỉnh sửa sản phẩm</a>
        </div>
    </nav>

    <div class="card">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif

            {{-- <p style="color:red">
                @if ($errors->any())
                    {{ $errors->first() }}
                @endif
            </p> --}}
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
                                    <img src="{{ asset('storage') . '/' . $image->image_path }}" alt="Product Image"
                                        class="img-fluid">
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

    {{-- Danh sách các thông số kỹ thuật của sản phẩm --}}
    <div class="card">
        <div class="card-header">
            <h2>Thông số kỹ thuật của sản phẩm</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên thông số</th>
                        <th>Giá trị</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_specs as $product_spec)
                        <tr>
                            <td>{{ $product_spec->id }}</td>
                            <td>{{ $product_spec->name }}</td>
                            <td>{{ $product_spec->value }}</td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#confirmDeleteModal{{ $product_spec->id }}">Xoá</button>

                                <!-- Modal xoá -->
                                <div class="modal fade" id="confirmDeleteModal{{ $product_spec->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xoá thông số kỹ thuật</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body pt-4 pb-4">
                                                <h4>Bạn chắc chắn muốn xoá thông số kỹ thuật này??</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-secondary" data-dismiss="modal">Huỷ
                                                    bỏ</button>
                                                <form
                                                    action="{{ route('admin.products.deleteSpec', ['id' => $product_spec]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Xác
                                                        nhận</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Thêm các thông số kỹ thuật của sản phẩm</h3>

            <form action="{{ route('admin.products.addSpec') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div id="specContainer">
                </div>
                <button type="button" class="btn btn-sm btn-secondary" id="addSpecButton">Thêm thông số kỹ thuật</button>
                <button type="submit" class="btn btn-sm btn-primary">Lưu thông số</button>
            </form>
        </div>
    </div>

    {{-- Danh sách các chính sách bảo hành của sản phẩm --}}
    <div class="card">
        <div class="card-header">
            <h2>Chính sách bảo hành của sản phẩm</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_warranty_policies as $product_warranty_policy)
                        <tr>
                            <td>{{ $product_warranty_policy->id }}</td>
                            <td>{{ $product_warranty_policy->title }}</td>
                            <td>{{ $product_warranty_policy->content }}</td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#confirmDeleteModal{{ $product_warranty_policy->id }}">Xoá</button>

                                <!-- Modal xoá -->
                                <div class="modal fade" id="confirmDeleteModal{{ $product_warranty_policy->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xoá thông số kỹ thuật</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body pt-4 pb-4">
                                                <h4>Bạn chắc chắn muốn xoá thông số kỹ thuật này??</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-secondary" data-dismiss="modal">Huỷ
                                                    bỏ</button>
                                                <form
                                                    action="{{ route('admin.products.deleteWarranty', ['id' => $product_warranty_policy]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Xác
                                                        nhận</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Thêm các chính sách bảo hành cho sản phẩm</h3>

            <form action="{{ route('admin.products.addWarranty') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div id="warrantyContainer">
                </div>
                <button type="button" class="btn btn-sm btn-secondary" id="addWarrantyButton">Thêm Chính sách bảo
                    hành</button>
                <button type="submit" class="btn btn-sm btn-primary">Lưu chính sách bảo hành</button>
            </form>
        </div>
    </div>

    {{-- Danh sách các khuyến mãi/ưu đãi của sản phẩm --}}
    <div class="card">
        <div class="card-header">
            <h2>Khuyến mãi/ưu đãi của sản phẩm</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product_promotions as $product_promotion)
                        <tr>
                            <td>{{ $product_promotion->id }}</td>
                            <td>{{ $product_promotion->title }}</td>
                            <td>{{ $product_promotion->description }}</td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#confirmDeleteModal{{ $product_promotion->id }}">Xoá</button>

                                <!-- Modal xoá -->
                                <div class="modal fade" id="confirmDeleteModal{{ $product_promotion->id }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xoá khuyến mãi/ưu đãi kỹ
                                                    thuật</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body pt-4 pb-4">
                                                <h4>Bạn chắc chắn muốn xoá khuyến mãi/ưu đãi này??</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-sm btn-secondary" data-dismiss="modal">Huỷ
                                                    bỏ</button>
                                                <form
                                                    action="{{ route('admin.products.deletePromotion', ['id' => $product_promotion]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Xác
                                                        nhận</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Thêm các khuyến mãi/ưu đãi của sản phẩm</h3>

            <form action="{{ route('admin.products.addPromotion') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div id="promotionContainer">
                </div>
                <button type="button" class="btn btn-sm btn-secondary" id="addPromotionButton">Thêm khuyến mãi/ưu
                    đãi</button>
                <button type="submit" class="btn btn-sm btn-primary">Lưu khuyến mãi/ưu đãi</button>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var specCount = 0;
            var warrantyCount = 0;
            var promotionCount = 0;

            // Thêm thông số kỹ thuật vào sản phẩm
            $('#addSpecButton').click(function(e) {
                e.preventDefault();

                specCount++;

                var newSpec = `
                    <div class="form-group">
                        <h3>Thông số kỹ thuật ${specCount}</h3>
                        <div class="form-group">
                            <label for="name_${specCount}">Tên thông số kỹ thuật</label>
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

            // Thêm thông số kỹ thuật vào sản phẩm
            $('#addWarrantyButton').click(function(e) {
                e.preventDefault();

                warrantyCount++;

                var newSpec = `
                    <div class="form-group">
                        <h3>Chính sách bảo hành ${warrantyCount}</h3>
                        <div class="form-group">
                            <label for="title_${warrantyCount}">Tiêu đề</label>
                            <input type="text" id="title_${warrantyCount}" name="warranties[${warrantyCount}][title]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content_${warrantyCount}">Nội dung</label>
                            <input type="text" id="content_${warrantyCount}" name="warranties[${warrantyCount}][content]" class="form-control">
                        </div>
                    </div>
                    `;

                $('#warrantyContainer').append(newSpec);
            });

            // Thêm khuyến mãi/ưu đãi cho sản phẩm
            $('#addPromotionButton').click(function(e) {
                e.preventDefault();

                promotionCount++;

                var newSpec = `
                    <div class="form-group">
                        <h3>Khuyến mãi/ưu đãi ${promotionCount}</h3>
                        <div class="form-group">
                            <label for="title_${promotionCount}">Tiêu đề</label>
                            <input type="text" id="title_${promotionCount}" name="promotions[${promotionCount}][title]" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description_${promotionCount}">Mô tả</label>
                            <input type="text" id="description_${promotionCount}" name="promotions[${promotionCount}][description]" class="form-control">
                        </div>
                    </div>
                    `;

                $('#promotionContainer').append(newSpec);
            });

        });

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
