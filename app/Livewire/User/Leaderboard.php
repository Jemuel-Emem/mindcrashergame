<?php

namespace App\Livewire\User;
use App\Models\User as user;
use Livewire\WithPagination;
use Livewire\Component;

class Leaderboard extends Component
{
    use  WithPagination;
    public $search;
    public function render()
    {
        $search = '%' .$this->search. '%';
        $search = '%' .$this->search. '%';
        $result = User::select(user::raw('name, users.id, (coins1 + coins2 + coins3) as total_score'))
                      ->where('name', 'like', $search)
                      ->orderByDesc('total_score')
                      ->paginate(10);

        return view('livewire.user.leaderboard', ['result' => $result]);

    }
}
