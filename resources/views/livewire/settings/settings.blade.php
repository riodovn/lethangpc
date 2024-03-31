<div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Quản lý các cài đặt của website</a>
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
            <!-- On tables -->
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tên thiết lập</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($website_title)
                        <tr>
                            <th>Tiêu đề trang web</th>
                            <td>{{ $website_title }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                    wire:click="editTitle({{ $website_title_setting->id }})">Chỉnh sửa</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click="deleteWebsiteTitle({{ $website_title_setting->id }})">Xoá</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th>Tiêu đề trang web</th>
                            <td>Không tìm thấy tiêu đề của trang web</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary"
                                    wire:click="addWebsiteTitle()">Thêm mới</button>
                            </td>
                        </tr>
                    @endif

                    @if ($company_name)
                        <tr>
                            <th>Tên công ty</th>
                            <td>{{ $company_name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                    wire:click="editCompanyName({{ $company_name_setting->id }})">Chỉnh sửa</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click="deleteCompanyName({{ $company_name_setting->id }})">Xoá</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th>Tên công ty</th>
                            <td>Không tìm thấy tên công ty</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" wire:click="addCompanyName()">Thêm
                                    mới</button>
                            </td>
                        </tr>
                    @endif

                    @if ($address)
                        <tr>
                            <th>Địa chỉ</th>
                            <td>{{ $address }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                    wire:click="editAddress({{ $address_setting->id }})">Chỉnh
                                    sửa</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click="deleteAddress({{ $address_setting->id }})">Xoá</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th>Địa chỉ</th>
                            <td>Không tìm thấy địa chỉ</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" wire:click="addAddress()">Thêm
                                    mới</button>
                            </td>
                        </tr>
                    @endif

                    @if ($phone_number)
                        <tr>
                            <th>Số điện thoại trang</th>
                            <td>{{ $phone_number }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                    wire:click="editPhoneNumber({{ $phone_number_setting->id }})">Chỉnh
                                    sửa</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click="deletePhoneNumber({{ $phone_number_setting->id }})">Xoá</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th>Số điện thoại trang</th>
                            <td>Không tìm thấy số điện thoại của trang</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" wire:click="addPhoneNumber()">Thêm
                                    mới</button>
                            </td>
                        </tr>
                    @endif

                    @if ($embed_code)
                        <tr>
                            <th>Embed code</th>
                            <td>{{ $embed_code }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                    wire:click="editEmbedCode({{ $embed_code_setting->id }})">Chỉnh
                                    sửa</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click="deleteEmbedCode({{ $embed_code_setting->id }})">Xoá</button>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th>Embed code</th>
                            <td>Không tìm thấy embed_code của trang</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" wire:click="addEmbedCode()">Thêm
                                    mới</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal tạo mới website_title -->
    <div wire:ignore.self class="modal fade" id="addWebsiteTitleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới tiêu đề trang web</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeTitle">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Tên tiêu đề trang web</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="website_title_temp" placeholder="Nhập tiêu đề của trang web">
                                @error('website_title_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm tiêu đề</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa website_title -->
    <div wire:ignore.self class="modal fade" id="editWebsiteTitleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa tiêu đề trang web</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateTitle">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Tên tiêu đề trang web</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="website_title_temp" placeholder="Nhập tiêu đề của trang web">
                                @error('website_title_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xoá tiêu đề của trang web -->
    <div wire:ignore.self class="modal fade" id="deleteWebsiteTitleModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá tiêu đề trang web</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá tiêu đề này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="confirmDeleteWebsiteTitle()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal tạo mới tên công ty -->
    <div wire:ignore.self class="modal fade" id="addCompanyNameModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới tên công ty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeCompanyName">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Tên công ty</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="company_name_temp" placeholder="Nhập tiêu đề của trang web">
                                @error('company_name_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm tên công ty</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa tên công ty -->
    <div wire:ignore.self class="modal fade" id="editCompanyNameModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa tên công ty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateCompanyName">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Tên công ty</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="company_name_temp" placeholder="Nhập tên công ty">
                                @error('company_name_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xoá tên công ty -->
    <div wire:ignore.self class="modal fade" id="deleteCompanyNameModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá tên công ty</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá tên công ty này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="confirmDeleteCompanyName()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tạo mới địa chỉ -->
    <div wire:ignore.self class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeAddress">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Địa chỉ</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="address_temp" placeholder="Nhập địa chỉ của trang web">
                                @error('address_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm địa chỉ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa địa chỉ -->
    <div wire:ignore.self class="modal fade" id="editAddressModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateAddress">
                        <div class="form-group">
                            <label for="address" class="col-6">Địa chỉ</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="address" wire:model="address_temp"
                                    placeholder="Nhập địa chỉ">
                                @error('address_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xoá tên công ty -->
    <div wire:ignore.self class="modal fade" id="deleteAddressModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá địa chỉ này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="confirmDeleteAddress()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tạo mới số điện thoại của trang -->
    <div wire:ignore.self class="modal fade" id="addPhoneNumberModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới số điện thoại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storePhoneNumber">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Số điện thoại</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="phone_number_temp" placeholder="Nhập số điện thoại của trang web">
                                @error('phone_number_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm số điện thoại</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa số điện thoại của trang -->
    <div wire:ignore.self class="modal fade" id="editPhoneNumber" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa số điện thoại của trang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updatePhoneNumber">
                        <div class="form-group">
                            <label for="address" class="col-6">Số điện thoại</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="address"
                                    wire:model="phone_number_temp" placeholder="Nhập số điện thoại">
                                @error('phone_number_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xoá số điện thoại của trang -->
    <div wire:ignore.self class="modal fade" id="deletePhoneNumberModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá số điện thoại của trang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá số điện thoại này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="confirmDeletePhoneNumber()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tạo mới embed_code -->
    <div wire:ignore.self class="modal fade" id="addEmbedCodeModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới embed_code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeEmbedCode">
                        <div class="form-group">
                            <label for="website_title" class="col-6">Embed code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="website_title"
                                    wire:model="embed_code_temp" placeholder="Nhập embed code">
                                @error('embed_code_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Thêm embed code</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal chỉnh sửa embed code -->
    <div wire:ignore.self class="modal fade" id="editEmbedCode" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa embed code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateEmbedCode">
                        <div class="form-group">
                            <label for="embed_code" class="col-6">Embed code</label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="embed_code"
                                    wire:model="embed_code_temp" placeholder="Nhập embed code">
                                @error('embed_code_temp')
                                    <span class="text-danger" style="font-size: 11.5px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xoá embed_code -->
    <div wire:ignore.self class="modal fade" id="deleteEmbedCodeModal" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xoá embed code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h4>Bạn chắc chắn muốn xoá embed code này??</h4>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="canncel()" data-bs-dismiss="modal"
                        aria-label="Close">Huỷ bỏ</button>
                    <button class="btn btn-sm btn-danger" wire:click="confirmDeleteEmbedCode()">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Close modal
    window.addEventListener('close-modal', event => {
        $('#addWebsiteTitleModal').modal('hide');
        $('#deleteWebsiteTitleModal').modal('hide');
        $('#addCompanyNameModal').modal('hide');
        $('#deleteCompanyNameModal').modal('hide');
        $('#addAddressModal').modal('hide');
        $('#deleteAddressModal').modal('hide');
        $('#addPhoneNumberModal').modal('hide');
        $('#deletePhoneNumberModal').modal('hide');
        $('#addEmbedCodeModal').modal('hide');
        $('#deleteEmbedCodeModal').modal('hide');
        $('#editWebsiteTitleModal').modal('hide');
        $('#editCompanyNameModal').modal('hide');
        $('#editAddressModal').modal('hide');
        $('#editPhoneNumber').modal('hide');
        $('#editEmbedCode').modal('hide');
    });

    // Thêm mới tiêu đề của trang web
    window.addEventListener('show-create-website-title-modal', event => {
        $('#addWebsiteTitleModal').modal('show');
    });

    // Chỉnh sửa tiêu đề của trang web
    window.addEventListener('show-edit-website-title-modal', event => {
        $('#editWebsiteTitleModal').modal('show');
    });

    // Xoá tiêu đề của trang web
    window.addEventListener('show-delete-website-title-modal', event => {
        $('#deleteWebsiteTitleModal').modal('show');
    });

    // Thêm mới tên công ty
    window.addEventListener('show-create-company-name-modal', event => {
        $('#addCompanyNameModal').modal('show');
    });

    // Chỉnh sửa tên công ty
    window.addEventListener('show-edit-company-name-modal', event => {
        $('#editCompanyNameModal').modal('show');
    });

    // Xoá tên công ty
    window.addEventListener('show-delete-company-name-modal', event => {
        $('#deleteCompanyNameModal').modal('show');
    });

    // Thêm mới địa chỉ
    window.addEventListener('show-create-address-modal', event => {
        $('#addAddressModal').modal('show');
    });

    // Chỉnh sửa địa chỉ
    window.addEventListener('show-edit-address-modal', event => {
        $('#editAddressModal').modal('show');
    });

    // Xoá địa chỉ
    window.addEventListener('show-delete-address-modal', event => {
        $('#deleteAddressModal').modal('show');
    });

    // Thêm số điện thoại của trang
    window.addEventListener('show-create-phone-number-modal', event => {
        $('#addPhoneNumberModal').modal('show');
    });

    // Chỉnh sửa số điện thoại của trang
    window.addEventListener('show-edit-phone-number-modal', event => {
        $('#editPhoneNumber').modal('show');
    });

    // Xoá số điện thoại
    window.addEventListener('show-delete-phone-number-modal', event => {
        $('#deletePhoneNumberModal').modal('show');
    });

    // Thêm embed code
    window.addEventListener('show-create-embed-code-modal', event => {
        $('#addEmbedCodeModal').modal('show');
    });

    // Chỉnh sửa embed code 
    window.addEventListener('show-edit-embed-code-modal', event => {
        $('#editEmbedCode').modal('show');
    });

    // Xoá embed code
    window.addEventListener('show-delete-embed-code-modal', event => {
        $('#deleteEmbedCodeModal').modal('show');
    });
</script>
