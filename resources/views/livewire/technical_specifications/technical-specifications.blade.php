<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Quản lý thông số kỹ thuật của sản phẩm</a>
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
                data-bs-target="#addTechnicalSpecificationModal">Tạo mới thông số kỹ thuật</button>
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
                        <th>Tên</th>
                        <th>Giá trị</th>
                        <th>Sản phẩm</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($technical_specifications->count() > 0)
                        @foreach ($technical_specifications as $technical_specification)
                            <tr>
                                <td>{{ $technical_specification->id }}</td>
                                <td>{{ $technical_specification->name }}</td>
                                <td>{{ $technical_specification->value }}</td>
                                <td>{{ $technical_specification->product->name }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-sm btn-warning"
                                        wire:click="edit({{ $technical_specification->id }})">Chỉnh
                                        sửa</button>
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $technical_specification->id }})">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center">No Technical Specification found</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div style="float: right;">
                                {{ $technical_specifications->appends(request()->input())->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal tạo mới -->
    <div wire:ignore.self class="modal fade" id="addTechnicalSpecificationModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới thông số kỹ thuật</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="nameProduct" class="col-3">Sản phẩm</label>
                            <div class="col-12">
                                <select wire:model="product_id" class="form-control" id="nameProduct">
                                    <option value="">{{ 'Chọn sản phẩm' }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach

                                </select>
                                @error('product_id')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nameTechnicalSpec" class="col-6">Thông số kỹ thuật</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nameTechnicalSpec" wire:model="name"
                                    placeholder="Nhập thông số kỹ thuật">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="valueTechnicalSpec" class="col-3">Giá trị</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="valueTechnicalSpec" wire:model="value"
                                    placeholder="Nhập giá trị">
                                @error('value')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm thông số kỹ thuật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa -->
    <div wire:ignore.self class="modal fade" id="editTechnicalSpecificationModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa thông số kỹ thuật</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="form-group">
                            <label for="nameProduct" class="col-3">Sản phẩm</label>
                            <div class="col-12">
                                <select wire:model="product_id" class="form-control" id="nameProduct">
                                    <option value="">{{ 'Chọn sản phẩm' }}</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach

                                </select>
                                @error('product_id')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nameTechnicalSpec" class="col-6">Thông số kỹ thuật</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="nameTechnicalSpec" wire:model="name"
                                    placeholder="Nhập thông số kỹ thuật">
                                @error('name')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="valueTechnicalSpec" class="col-3">Giá trị</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="valueTechnicalSpec"
                                    wire:model="value" placeholder="Nhập giá trị">
                                @error('value')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa thông số kỹ thuật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xoá -->
    <div wire:ignore.self class="modal fade" id="deleteTechnicalSpecificationModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá thông số kỹ thuật</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá thông số kỹ thuật này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteTechnicalSpecification()">Xác
                        nhận</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('close-modal', event => {
        $('#addTechnicalSpecificationModal').modal('hide');
        $('#editTechnicalSpecificationModal').modal('hide');
        $('#deleteTechnicalSpecificationModal').modal('hide');
    });

    window.addEventListener('show-edit-technical-specification-modal', event => {
        $('#editTechnicalSpecificationModal').modal('show');
    });

    window.addEventListener('show-delete-technical_specification-modal', event => {
        $('#deleteTechnicalSpecificationModal').modal('show');
    });
</script>
