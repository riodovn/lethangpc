<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class Settings extends Component
{
    public $website_title, $company_name, $address, $phone_number, $embed_code;

    public $website_title_temp, $company_name_temp, $address_temp, $phone_number_temp, $embed_code_temp;

    public $website_title_delete_id, $company_name_delete_id, $address_delete_id, $phone_number_delete_id, $embed_code_delete_id;

    public $website_title_edit_id, $company_name_edit_id, $address_edit_id, $phone_number_edit_id, $embed_code_edit_id;

    public function resetFields()
    {
        $this->website_title_temp = '';
        $this->company_name_temp = '';
        $this->address_temp = '';
        $this->phone_number_temp = '';
        $this->embed_code_temp = '';
    }

    public function render()
    {
        $website_title_setting = Setting::where('website_title', '!=', null)->first();

        $this->website_title = $website_title_setting ? $website_title_setting->website_title : '';

        $company_name_setting = Setting::where('company_name', '!=', null)->first();

        $this->company_name = $company_name_setting ? $company_name_setting->company_name : '';

        $address_setting = Setting::where('company_address', '!=', null)->first();

        $this->address = $address_setting ? $address_setting->company_address : '';

        $phone_number_setting = Setting::where('phone_number', '!=', null)->first();

        $this->phone_number = $phone_number_setting ? $phone_number_setting->phone_number : '';

        $embed_code_setting = Setting::where('embed_code', '!=', null)->first();

        $this->embed_code = $embed_code_setting ? $embed_code_setting->embed_code : '';

        //dd($website_title);

        return view('livewire.settings.settings', ['website_title' => $this->website_title, 'website_title_setting' => $website_title_setting, 'company_name' => $this->company_name, 'company_name_setting' => $company_name_setting, 'address_setting' => $address_setting, 'address' => $this->address, 'phone_number' => $this->phone_number, 'phone_number_setting' => $phone_number_setting, 'embed_code' => $this->embed_code, 'embed_code_setting' => $embed_code_setting]);
    }

    public function addWebsiteTitle()
    {
        $this->dispatchBrowserEvent('show-create-website-title-modal');
    }

    public function storeTitle()
    {
        $this->validate([
            'website_title_temp' => 'required',
        ]);

        try {
            $website_title_setting = new Setting();
            $website_title_setting->website_title = $this->website_title_temp;
            $website_title_setting->save();
            session()->flash('success', 'Tạo mới thành công tiêu đề của trang web!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới tiêu đề của trang web, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function editTitle($id)
    {
        $website_title_setting = Setting::where('id', $id)->first();
        $this->website_title_temp = $website_title_setting->website_title;
        $this->website_title_edit_id = $website_title_setting->id;
        $this->dispatchBrowserEvent('show-edit-website-title-modal');
    }

    public function updateTitle()
    {
        $this->validate([
            'website_title_temp' => 'required',
        ]);

        try {
            $website_title_setting = Setting::where('id', $this->website_title_edit_id)->first();
            $website_title_setting->website_title = $this->website_title_temp;
            $website_title_setting->save();
            $this->website_title_edit_id = '';

            session()->flash('success', 'Đã chỉnh sửa tiêu đề của trang web thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình chỉnh sửa tiêu đề của trang web, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function deleteWebsiteTitle($id)
    {
        $this->website_title_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-website-title-modal');
    }

    public function confirmDeleteWebsiteTitle()
    {
        $website_title_setting = Setting::where('id', $this->website_title_delete_id)->first();
        //dd($website_title_setting);
        $website_title_setting->delete();

        session()->flash('success', 'Xoá tiêu đề của trang web thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->website_title_delete_id = '';
    }

    public function addCompanyName()
    {
        $this->dispatchBrowserEvent('show-create-company-name-modal');
    }

    public function storeCompanyName()
    {
        $this->validate([
            'company_name_temp' => 'required',
        ]);

        try {
            $company_name_setting = new Setting();
            $company_name_setting->company_name = $this->company_name_temp;
            $company_name_setting->save();
            session()->flash('success', 'Tạo mới tên công ty thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới tên công ty, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function editCompanyName($id)
    {
        $company_name_setting = Setting::where('id', $id)->first();
        $this->company_name_temp = $company_name_setting->company_name;
        $this->company_name_edit_id = $company_name_setting->id;
        $this->dispatchBrowserEvent('show-edit-company-name-modal');
    }

    public function updateCompanyName()
    {
        $this->validate([
            'company_name_temp' => 'required',
        ]);

        try {
            $company_name_setting = Setting::where('id', $this->company_name_edit_id)->first();
            $company_name_setting->company_name = $this->company_name_temp;
            $company_name_setting->save();

            $this->company_name_edit_id = '';
            session()->flash('success', 'Đã chỉnh sửa tên công ty thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra trong quá trình chỉnh sửa tên công ty, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function deleteCompanyName($id)
    {
        $this->company_name_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-company-name-modal');
    }

    public function confirmDeleteCompanyName()
    {
        $company_name_setting = Setting::where('id', $this->company_name_delete_id)->first();
        //dd($website_title_setting);
        $company_name_setting->delete();

        session()->flash('success', 'Xoá tên công ty thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->company_name_delete_id = '';
    }

    public function addAddress()
    {
        $this->dispatchBrowserEvent('show-create-address-modal');
    }

    public function storeAddress()
    {
        $this->validate([
            'address_temp' => 'required',
        ]);

        try {
            $address_setting = new Setting();
            $address_setting->company_address = $this->address_temp;
            $address_setting->save();
            session()->flash('success', 'Tạo mới địa chỉ thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới địa chỉ, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function editAddress($id)
    {
        $address_setting = Setting::where('id', $id)->first();
        $this->address_temp = $address_setting->company_address;
        $this->address_edit_id = $address_setting->id;
        $this->dispatchBrowserEvent('show-edit-address-modal');
    }

    public function updateAddress()
    {
        $this->validate([
            'address_temp' => 'required',
        ]);

        try {
            $address_setting = Setting::where('id', $this->address_edit_id)->first();
            $address_setting->company_address = $this->address_temp;
            $address_setting->save();

            $this->address_edit_id = '';
            session()->flash('success', 'Đã chỉnh sửa địa chỉ thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra trong quá trình chỉnh sửa địa chỉ, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function deleteAddress($id)
    {
        $this->address_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-address-modal');
    }

    public function confirmDeleteAddress()
    {
        $address_setting = Setting::where('id', $this->address_delete_id)->first();
        //dd($website_title_setting);
        $address_setting->delete();

        session()->flash('success', 'Xoá địa chỉ thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->address_delete_id = '';
    }

    public function addPhoneNumber()
    {
        $this->dispatchBrowserEvent('show-create-phone-number-modal');
    }

    public function storePhoneNumber()
    {
        $this->validate([
            'phone_number_temp' => 'required',
        ]);

        try {
            $phone_number_setting = new Setting();
            $phone_number_setting->phone_number = $this->phone_number_temp;
            $phone_number_setting->save();
            session()->flash('success', 'Tạo mới số điện thoại thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới số điện thoại, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function editPhoneNumber($id)
    {
        $phone_number_setting = Setting::where('id', $id)->first();
        $this->phone_number_temp = $phone_number_setting->phone_number;
        $this->phone_number_edit_id = $phone_number_setting->id;
        $this->dispatchBrowserEvent('show-edit-phone-number-modal');
    }

    public function updatePhoneNumber()
    {
        $this->validate([
            'phone_number_temp' => 'required',
        ]);

        try {
            $phone_number_setting = Setting::where('id', $this->phone_number_edit_id)->first();
            $phone_number_setting->phone_number = $this->phone_number_temp;
            $phone_number_setting->save();

            $this->phone_number_edit_id = '';
            session()->flash('success', 'Đã chỉnh sửa số điện thoại thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra trong quá trình chỉnh sửa số điện thoại, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function deletePhoneNumber($id)
    {
        $this->phone_number_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-phone-number-modal');
    }

    public function confirmDeletePhoneNumber()
    {
        $phone_number_setting = Setting::where('id', $this->phone_number_delete_id)->first();
        //dd($website_title_setting);
        $phone_number_setting->delete();

        session()->flash('success', 'Xoá số điện thoại thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->phone_number_delete_id = '';
    }

    public function addEmbedCode()
    {
        $this->dispatchBrowserEvent('show-create-embed-code-modal');
    }

    public function storeEmbedCode()
    {
        $this->validate([
            'embed_code_temp' => 'required',
        ]);

        try {
            $embed_code_setting = new Setting();
            $embed_code_setting->embed_code = $this->embed_code_temp;
            $embed_code_setting->save();
            session()->flash('success', 'Tạo mới embed code thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới embed code, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function editEmbedCode($id)
    {
        $embed_code_setting = Setting::where('id', $id)->first();
        $this->embed_code_temp = $embed_code_setting->embed_code;
        $this->embed_code_edit_id = $embed_code_setting->id;
        $this->dispatchBrowserEvent('show-edit-embed-code-modal');
    }

    public function updateEmbedCode()
    {
        $this->validate([
            'embed_code_temp' => 'required',
        ]);

        try {
            $embed_code_setting = Setting::where('id', $this->embed_code_edit_id)->first();
            $embed_code_setting->phone_number = $this->embed_code_temp;
            $embed_code_setting->save();

            $this->embed_code_edit_id = '';
            session()->flash('success', 'Đã chỉnh sửa embed code thành công!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Có lỗi xảy ra trong quá trình chỉnh sửa embed code, mời bạn thao tác lại!');
            $this->resetFields();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function deleteEmbedCode($id)
    {
        $this->embed_code_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-embed-code-modal');
    }

    public function confirmDeleteEmbedCode()
    {
        $embed_code_setting = Setting::where('id', $this->embed_code_delete_id)->first();
        //dd($website_title_setting);
        $embed_code_setting->delete();

        session()->flash('success', 'Xoá embed code thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->embed_code_delete_id = '';
    }
}
