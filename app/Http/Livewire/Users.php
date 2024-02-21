<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $paginationTheme = 'bootstrap';

    public $searchKeyword;

    public $view_user_id, $view_user_name, $view_user_email, $view_user_created_at;

    public function render()
    {
        $searchKeyword = '%' . $this->searchKeyword . '%';

        $users = User::where('name', 'like', $searchKeyword)->orWhere('email', 'like', $searchKeyword)->orderBy('id', 'asc')->paginate(3);

        return view('livewire.users.users', ['users' => $users]);
    }

    public function view($id){
        $user = User::where('id', $id)->first();
        $this->view_user_id = $user->id;
        $this->view_user_name = $user->name;
        $this->view_user_email = $user->email;
        $this->view_user_created_at = $user->created_at;

        $this->dispatchBrowserEvent('show-view-user-modal');
    }

    public function closeViewUserModal(){
        $this->view_user_id = '';
        $this->view_user_name = '';
        $this->view_user_email = '';
        $this->view_user_created_at = '';
    }
}
