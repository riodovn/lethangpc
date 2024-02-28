<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Quản lý banner/slider</a>
            <form class="d-flex">
                <input class="form-control me-2" type="text" wire:model="searchKeyword" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#addBannerModal">Tạo mới banner/slider</button>
        </div>

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

            <!-- Hiển thị danh sách danh mục sản phẩm -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($banners->count() > 0)
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td style="text-align: center">
                                    @if ($banner->image_id != null)
                                        <img src="{{ asset($banner->image->path) }}" alt="" width="100"
                                            height="100">
                                    @endif
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->description }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-sm btn-secondary" wire:click="view({{ $banner->id }})">Chi
                                        tiết</button>
                                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $banner->id }})">Chỉnh
                                        sửa</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $banner->id }})">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center">No Banner found</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div style="float: right;">
                                {{ $banners->appends(request()->input())->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal tạo mới -->
    <div wire:ignore.self class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới banner/slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="imageBanner{{ $iteration }}" class="col-3">Hình ảnh</label>
                            <div class="col-12">
                                <input type="file" class="form-control" id="imageBanner{{ $iteration }}"
                                    wire:model="image" name="image">
                                @error('image')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nameBanner" class="col-3">Tiêu đề</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nameBanner" wire:model="title"
                                    placeholder="Nhập tiêu đề">
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionBanner" class="col-3">Mô tả</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="descriptionBanner"
                                    wire:model="description" placeholder="Mô tả">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm banner/slider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa -->
    <div wire:ignore.self class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa banner/slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="imageBanner" class="col-3">Hình ảnh</label>
                            <div class="col-12">
                                <input type="file" class="form-control" id="imageBanner" wire:model="image">
                                @error('image')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror

                                @if ($selectedImage)
                                    <div style="margin-top: 10px">
                                        <img src="{{ asset($selectedImage) }}" alt="" width="100"
                                            height="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titleBanner" class="col-3">Tiêu đề</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="titleBanner" wire:model="title"
                                    placeholder="Nhập tiêu đề">
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionBanner" class="col-3">Mô tả</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="descriptionBanner"
                                    wire:model="description" placeholder="Nhập mô tả">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa banner/slider</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chi tiết -->
    <div wire:ignore.self class="modal fade" id="viewBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết banner/slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeViewBannerModal()"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $view_banner_id }}</td>
                            </tr>
                            <tr>
                                <th>Hình ảnh</th>
                                <td>
                                    @if ($view_banner_image)
                                        <img src="{{ asset($view_banner_image) }}" alt="" width="100"
                                            height="100">
                                    @else
                                        <p>Không có hình ảnh</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tiêu đề</th>
                                <td>{{ $view_banner_title }}</td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td>{{ $view_banner_description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal xoá -->
    <div wire:ignore.self class="modal fade" id="deleteBannerModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá banner/slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá banner/slider này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteBanner()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('close-modal', event => {
        $('#addBannerModal').modal('hide');
        $('#editBannerModal').modal('hide');
        $('#deleteBannerModal').modal('hide');
    });

    window.addEventListener('show-edit-banner-modal', event => {
        $('#editBannerModal').modal('show');
    });

    window.addEventListener('show-delete-banner-modal', event => {
        $('#deleteBannerModal').modal('show');
    });

    window.addEventListener('show-view-banner-modal', event => {
        $('#viewBannerModal').modal('show');
    });
</script>
