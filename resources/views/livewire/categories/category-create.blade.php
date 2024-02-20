<div class="modal" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm mới category</h5>
                <button type="button" wire:click="cancel()" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nameCategory" class="form-label">Tên danh mục</label>
                        <input type="text" wire:model="name" class="form-control" id="nameCategory"
                            placeholder="Nhập tên danh mục">
                    </div>

                    <div class="mb-3">
                        <label for="descriptionCategory" class="form-label">Mô tả</label>
                        <input type="text" wire:model="description" class="form-control" id="descriptionCategory"
                            placeholder="Mô tả">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button wire:click="process_create_category()" class="btn btn-success">Thêm mới</button>
                <button wire:click="cancel()" class="btn btn-danger">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>
