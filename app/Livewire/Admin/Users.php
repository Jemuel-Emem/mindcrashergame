<?php

namespace App\Livewire\Admin;
use App\Models\User as user;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
class Users extends Component
{
    use Actions;
    use  WithPagination;
    public $search;
    public function render()
    {
        $search = '%' .$this->search. '%';
        return view('livewire.admin.users',[
            'users' => user::where('name', 'like', $search)->paginate(10),
        ]);

    }
}
