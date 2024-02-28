<?php

namespace App\Http\Livewire;

use App\Models\File;
use Livewire\Component;
use Livewire\WithPagination;

class Files extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $searchKeyword;

    public $file_delete_id;

    public function render()
    {
        $searchKeyword = '%' . $this->searchKeyword . '%';
        $files = File::where('path', 'like', $searchKeyword)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.files.files', ['files' => $files]);
    }

    public function delete($id){
        $this->file_delete_id = $id;

        $this->dispatchBrowserEvent('show-delete-file-modal');
    }

    public function deleteFile(){
        $file = File::where('id', $this->file_delete_id)->first();
        
        $file->delete();

        session()->flash('success', 'Xoá file thành công!');

        // Hide modal after delete category
        $this->dispatchBrowserEvent('close-modal');

        $this->file_delete_id = '';
    }

    public function canncel(){
        $this->file_delete_id = '';
    }
}
