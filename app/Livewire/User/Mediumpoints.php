<?php

namespace App\Livewire\User;
use app\Models\coins as Coins;
use App\Models\User as UserCoins;
use Livewire\Component;

class Mediumpoints extends Component
{
    public $score2;
    public function mount($score2)
    {
        $this->score2 = $score2;

    }

    public function render()
    {

        return view('livewire.user.mediumpoints');
    }
}
