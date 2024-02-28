<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Quản lý file upload</a>
            <form class="d-flex">
                <input class="form-control me-2" type="text" wire:model="searchKeyword" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
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

            <!-- Hiển thị danh sách danh mục sản phẩm -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Filename</th>
                        <th>Path</th>
                        <th>Size</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($files->count() > 0)
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->id }}</td>
                                <td>{{ $file->filename }}</td>
                                <td>{{ $file->path }}</td>
                                <td>{{ $file->size }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-sm btn-danger"
                                        wire:click="delete({{ $file->id }})">Xóa</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center">No File found</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div style="float: right;">
                                {{ $files->appends(request()->input())->links() }}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Modal xoá -->
    <div wire:ignore.self class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá file</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá file này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteFile()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    window.addEventListener('close-modal', event => {
        $('#deleteFileModal').modal('hide');
    });

    window.addEventListener('show-delete-file-modal', event => {
        $('#deleteFileModal').modal('show');
    });
</script>
