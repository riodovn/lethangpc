<?php

namespace App\Http\Livewire;

use App\Models\Promotion;
use Livewire\Component;
use Livewire\WithPagination;

class Promotions extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $title, $description;

    public $promotion_edit_id, $promotion_delete_id, $view_promotion_id, $view_promotion_title, $view_promotion_description;

    public $searchKeyword;

    public function updated($fields){
        $this->validateOnly($fields, [
            'title' => 'required|unique:promotions',
        ]);
    }

    public function resetFields(){
        $this->title = '';
        $this->description = '';
    }

    public function render()
    {
        $searchKeyword = '%' . $this->searchKeyword . '%';

        $promotions = Promotion::where('title', 'like', $searchKeyword)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.promotions.promotions', ['promotions' => $promotions]);
    }

    public function store(){
        $this->validate([
            'title' => 'required|unique:promotions',
        ]);

        try {
            $promotion = new Promotion();
            $promotion->title = $this->title;
            $promotion->description = $this->description;
            $promotion->save();

            session()->flash('success', 'Tạo mới ưu đãi thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình tạo mới khuyến mãi, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function edit($id){
        $promotion = Promotion::where('id', $id)->first();
        $this->title = $promotion->title;
        $this->description = $promotion->description;
        $this->promotion_edit_id = $promotion->id;

        $this->dispatchBrowserEvent('show-edit-promotion-modal');
    }

    public function update(){
        $this->validate([
            'title' => 'required|unique:promotions',
        ]);

        try {
            $promotion = Promotion::where('id', $this->promotion_edit_id)->first();
        
            $promotion->title = $this->title;
            $promotion->description = $this->description;
            $promotion->save();

            session()->flash('success', 'Chỉnh sửa ưu đãi thành công!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        } catch (\Exception $e) {
            session()->flash('error', 'Đã có lỗi xảy ra trong quá trình chỉnh sửa ưu đãi, mời bạn thao tác lại!');

            $this->resetFields();

            // Hide modal after add category
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delete($id){
        $this->promotion_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-promotion-modal');
    }

    public function deletePromotion(){
        $promotion = Promotion::where('id', $this->promotion_delete_id)->first();
        
        $promotion->delete();

        session()->flash('success', 'Xoá ưu đãi thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->promotion_delete_id = '';
    }

    public function canncel(){
        $this->promotion_delete_id = '';
    }

    public function view($id){
        $promotion = Promotion::where('id', $id)->first();
        $this->view_promotion_id = $promotion->id;
        $this->view_promotion_title = $promotion->title;
        $this->view_promotion_description = $promotion->description;

        $this->dispatchBrowserEvent('show-view-promotion-modal');
    }

    public function closeViewPromotionModal(){
        $this->view_promotion_id = '';
        $this->view_promotion_title = '';
        $this->view_promotion_description = '';
    }
}
