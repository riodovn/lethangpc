<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\TechnicalSpec;
use Livewire\Component;
use Livewire\WithPagination;

class TechnicalSpecifications extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $searchKeyword;

    public $name, $value, $product_id;

    public $technical_specification_edit_id, $technical_specification_delete_id;

    public function updated($fields){
        $this->validateOnly($fields, [
            'product_id' =>'required',
            'name' => 'required',
            'value' => 'required',
        ]);
    }

    public function resetFields(){
        $this->name = '';
        $this->value = '';
        $this->product_id = '';
    }

    public function render()
    {
        $products = Product::all();

        $searchKeyword = '%' . $this->searchKeyword . '%';

        $technical_specifications = TechnicalSpec::where('name', 'like', $searchKeyword)->orWhere('value', 'like', $searchKeyword)->orderBy('id', 'asc')->paginate(10);

        return view('livewire.technical_specifications.technical-specifications', ['technical_specifications' => $technical_specifications, 'products' => $products]);
    }

    public function store(){
        //dd($this->all());

        $this->validate([
            'product_id' =>'required',
            'name' =>'required',
            'value' =>'required',
        ]);

        try {
            $technical_specification = new TechnicalSpec();
            $technical_specification->name = $this->name;
            $technical_specification->value = $this->value;
            $technical_specification->product_id = $this->product_id;
            $technical_specification->save();

            session()->flash('success', 'Tạo mới thông số kỹ thuật thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã xảy ra lỗi trong quá trình thêm mới thông số kỹ thuật, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function edit($id){
        $technical_specification = TechnicalSpec::where('id', $id)->first();
        $this->product_id = $technical_specification->product_id;
        $this->name = $technical_specification->name;
        $this->value = $technical_specification->value;
        $this->technical_specification_edit_id = $technical_specification->id;

        $this->dispatchBrowserEvent('show-edit-technical-specification-modal');
    }

    public function update(){
        $this->validate([
            'product_id' =>'required',
            'name' =>'required',
            'value' =>'required',
        ]);

        try {
            $technical_specification = TechnicalSpec::where('id', $this->technical_specification_edit_id)->first();
            $technical_specification->name = $this->name;
            $technical_specification->value = $this->value;
            $technical_specification->product_id = $this->product_id;

            $technical_specification->save();

            session()->flash('success', 'Chỉnh sửa thông số kỹ thuật thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã xảy ra lỗi trong quá trình chỉnh sửaawr thông số kỹ thuật, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delete($id){
        $this->technical_specification_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-technical_specification-modal');
    }

    public function deleteTechnicalSpecification(){
        $technical_specification = TechnicalSpec::where('id', $this->technical_specification_delete_id)->first();
        
        $technical_specification->delete();

        session()->flash('success', 'Xoá danh mục thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->technical_specification_delete_id = '';
    }

    public function canncel(){
        $this->technical_specification_delete_id = '';
    }
}
