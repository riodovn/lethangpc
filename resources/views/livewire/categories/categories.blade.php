<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Quản lý danh mục sản phẩm</a>
            <form class="d-flex">
                <input class="form-control me-2" type="text" wire:model="searchKeyword" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    {{-- @if ($createCategoryModal)
        @include('livewire.categories.category-create')
    @endif --}}

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                data-bs-target="#addCategoryModal">Tạo mới
                danh
                mục</button>
        </div>

        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hiển thị danh sách danh mục sản phẩm -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->count() > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-sm btn-secondary" wire:click="view({{ $category->id }})">Chi
                                        tiết</button>
                                    <button class="btn btn-sm btn-warning" wire:click="edit({{ $category->id }})">Chỉnh
                                        sửa</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $category->id }})">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center">No Category found</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div style="float: right;">
                                {{ $categories->appends(request()->input())->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal tạo mới -->
    <div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="nameCategory" class="col-3">Tên danh mục</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nameCategory" wire:model="name"
                                    placeholder="Nhập tên danh mục">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionCategory" class="col-3">Mô tả</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="descriptionCategory"
                                    wire:model="description" placeholder="Mô tả">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa -->
    <div wire:ignore.self class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="nameCategory" class="col-3">Tên danh mục</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nameCategory" wire:model="name"
                                    placeholder="Nhập tên danh mục">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descriptionCategory" class="col-3">Mô tả</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="descriptionCategory"
                                    wire:model="description" placeholder="Mô tả">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa danh mục</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chi tiết -->
    <div wire:ignore.self class="modal fade" id="viewCategoryModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeViewCategoryModal()"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $view_category_id }}</td>
                            </tr>
                            <tr>
                                <th>Tên danh mục</th>
                                <td>{{ $view_category_name }}</td>
                            </tr>
                            <tr>
                                <th>Mô tả</th>
                                <td>{{ $view_category_description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal xoá -->
    <div wire:ignore.self class="modal fade" id="deleteCategoryModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá danh mục này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteCategory()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('close-modal', event => {
        $('#addCategoryModal').modal('hide');
        $('#editCategoryModal').modal('hide');
        $('#deleteCategoryModal').modal('hide');
    });

    window.addEventListener('show-edit-category-modal', event => {
        $('#editCategoryModal').modal('show');
    });

    window.addEventListener('show-delete-category-modal', event => {
        $('#deleteCategoryModal').modal('show');
    });

    window.addEventListener('show-view-category-modal', event => {
        $('#viewCategoryModal').modal('show');
    });
</script>
