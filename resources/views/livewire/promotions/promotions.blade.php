<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Quản lý các khuyến mãi/ưu đãi của shop</a>
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
                data-bs-target="#addPromotionModal">Tạo mới khuyến mãi</button>
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
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($promotions->count() > 0)
                        @foreach ($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion->id }}</td>
                                <td>{{ $promotion->title }}</td>
                                <td>{{ $promotion->description }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-sm btn-secondary" wire:click="view({{ $promotion->id }})">Chi
                                        tiết</button>
                                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $promotion->id }})">Chỉnh
                                        sửa</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $promotion->id }})">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center">No Promotion found</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div style="float: right;">
                                {{ $promotions->appends(request()->input())->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal tạo mới -->
    <div wire:ignore.self class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới khuyến mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="titlePromotion" class="col-3">Tiêu đề</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="titlePromotion" wire:model="title"
                                    placeholder="Nhập tiêu đề khuyến mãi">
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionPromotion" class="col-3">Mô tả</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="descriptionPromotion"
                                    wire:model="description" placeholder="Nhập mô tả">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm khuyến mãi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa -->
    <div wire:ignore.self class="modal fade" id="editPromotionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa khuyến mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="titlePromotion" class="col-3">Tiêu đề</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="titlePromotion" wire:model="title"
                                    placeholder="Nhập tiêu đề khuyến mãi">
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionPromotion" class="col-3">Mô tả</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="descriptionPromotion"
                                    wire:model="description" placeholder="Nhập mô tả">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa khuyến mãi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chi tiết -->
    <div wire:ignore.self class="modal fade" id="viewPromotionModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết khuyến mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeViewPromotionModal()"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $view_promotion_id }}</td>
                            </tr>
                            <tr>
                                <th>Tiêu đề</th>
                                <td>{{ $view_promotion_title }}</td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td>{{ $view_promotion_description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal xoá -->
    <div wire:ignore.self class="modal fade" id="deletePromotionModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá danh mục khuyến mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá danh mục khuyến mãi này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="deletePromotion()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('close-modal', event => {
        $('#addPromotionModal').modal('hide');
        $('#editPromotionModal').modal('hide');
        $('#deletePromotionModal').modal('hide');
    });

    window.addEventListener('show-edit-promotion-modal', event => {
        $('#editPromotionModal').modal('show');
    });

    window.addEventListener('show-delete-promotion-modal', event => {
        $('#deletePromotionModal').modal('show');
    });

    window.addEventListener('show-view-promotion-modal', event => {
        $('#viewPromotionModal').modal('show');
    });
</script>
