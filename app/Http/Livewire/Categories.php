<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $name, $description, $category_edit_id, $category_delete_id;
    public $searchKeyword;

    public $view_category_id, $view_category_name, $view_category_description;

    public function resetFields(){
        $this->name = '';
        $this->description = '';
    }

    public function updated($fields){
        $this->validateOnly($fields, [
            'name' => 'required|unique:categories',
        ]);
    }

    public function render()
    {
        $searchKeyword = '%' . $this->searchKeyword . '%';
        $categories = Category::where('name', 'like', $searchKeyword)->orderBy('id', 'asc')->paginate(10);

        return view('livewire.categories.categories', ['categories' => $categories]);
    }

    public function store(){
        $this->validate([
            'name' => 'required|unique:categories',
        ]);

        try {
            $category = new Category();
            $category->name = $this->name;
            $category->description = $this->description;
            $category->save();

            session()->flash('success', 'Tạo mới danh mục thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới danh mục, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function edit($id){
        $category = Category::where('id', $id)->first();
        $this->name = $category->name;
        $this->description = $category->description;
        $this->category_edit_id = $category->id;

        $this->dispatchBrowserEvent('show-edit-category-modal');
    }

    public function update(){
        $this->validate([
            'name' => 'required|unique:categories',
        ]);

        try {
            $category = Category::where('id', $this->category_edit_id)->first();
        
            $category->name = $this->name;
            $category->description = $this->description;
            $category->save();

            session()->flash('success', 'Chỉnh sửa danh mục thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình chỉnh sửa danh mục, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delete($id){
        $this->category_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-category-modal');
    }

    public function deleteCategory(){
        $category = Category::where('id', $this->category_delete_id)->first();
        
        $category->delete();

        session()->flash('success', 'Xoá danh mục thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->category_delete_id = '';
    }

    public function canncel(){
        $this->category_delete_id = '';
    }

    public function view($id){
        $category = Category::where('id', $id)->first();
        $this->view_category_id = $category->id;
        $this->view_category_name = $category->name;
        $this->view_category_description = $category->description;

        $this->dispatchBrowserEvent('show-view-category-modal');
    }

    public function closeViewCategoryModal(){
        $this->view_category_id = '';
        $this->view_category_name = '';
        $this->view_category_description = '';
    }
}
