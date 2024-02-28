<?php

namespace App\Http\Livewire;

use App\Models\Banner;
use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as ImageTool;

class Banners extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $paginationTheme = 'bootstrap';

    public $title, $description, $image, $searchKeyword, $selectedImage;

    public $iteration = 0;

    public $banner_edit_id, $banner_delete_id;

    public $view_banner_id, $view_banner_image, $view_banner_title, $view_banner_description;

    public function resetFields(){
        $this->image = null;
        $this->iteration++;
        $this->title = '';
        $this->description = '';
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'title' => 'required|unique:banners',
        ]);
    }

    public function render()
    {
        $searchKeyword = '%' . $this->searchKeyword . '%';

        $banners = Banner::where('title', 'like', $searchKeyword)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.banners.banners', ['banners' => $banners]);
    }

    public function store(){
        $this->validate([
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required|unique:banners',
        ]);

        try {
            $image = $this->image;
            $filename = $image->hashName();
            $image_resize = ImageTool::make($image->getRealPath());
            $image_resize->resize(150, 150);
            //dd(1);
            $path = $image_resize->save(public_path('image/banners/' . $filename));
            $size = $image->getSize();
            //dd($size);

            $file = new File();
            $file->filename = $filename;
            $file->path = 'image/banners/' . $filename;
            $file->size = $size;
            $file->save();

            Banner::create([
                'title' => $this->title,
                'description' => $this->description,
                'image_id' => $file->id,
            ]);

            session()->flash('success', 'Tạo mới banner/slider thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới banner/slider, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function edit($id){
        $banner = Banner::where('id', $id)->first();
        $this->title = $banner->title;
        $this->description = $banner->description;
        $this->banner_edit_id = $banner->id;
        $this->selectedImage = $banner->image_id != null ? $banner->image->path : null;

        $this->dispatchBrowserEvent('show-edit-banner-modal');
    }

    public function update(){
        $this->validate([
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required',
        ]);

        try {
            $banner = Banner::where('id', $this->banner_edit_id)->first();

            if($this->image == null){
                $banner->update([
                    'title' => $this->title,
                    'description' => $this->description,
                ]);
            }else{
                $image = $this->image;
                $filename = $image->hashName();
                $image_resize = ImageTool::make($image->getRealPath());
                $image_resize->resize(150, 150);
                //dd(1);
                $path = $image_resize->save(public_path('image/banners/' . $filename));
                $size = $image->getSize();
                //dd($size);

                $file = new File();
                $file->filename = $filename;
                $file->path = 'image/banners/' . $filename;
                $file->size = $size;
                $file->save();

                $banner->update([
                    'title' => $this->title,
                    'description' => $this->description,
                    'image_id' => $file->id,
                ]);
            }
        
            session()->flash('success', 'Chỉnh sửa banner/slider thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình chỉnh sửa banner/slider, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delete($id){
        $this->banner_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-banner-modal');
    }

    public function deleteBanner(){
        $banner = Banner::where('id', $this->banner_delete_id)->first();
        
        $banner->delete();

        session()->flash('success', 'Xoá banner/slider thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->banner_delete_id = '';
    }

    public function canncel(){
        $this->banner_delete_id = '';
    }

    public function view($id){
        $banner = Banner::where('id', $id)->first();
        $this->view_banner_id = $banner->id;
        $this->view_banner_image = $banner->image_id != null ? $banner->image->path : null;
        $this->view_banner_title = $banner->title;
        $this->view_banner_description = $banner->description;

        $this->dispatchBrowserEvent('show-view-banner-modal');
    }

    public function closeViewBannerModal(){
        $this->view_banner_id = '';
        $this->view_banner_image = null;
        $this->view_banner_title = '';
        $this->view_banner_description = '';
    }
}
