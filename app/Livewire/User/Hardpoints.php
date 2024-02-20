<?php

namespace App\Livewire\User;

use Livewire\Component;

class Hardpoints extends Component
{

    public $score;
    public $score3;
    public $add_modal = false;
    public function mount($score3)
    {
        $user = auth()->user();

        $this->score = $score3;

    }
    public function render()
    {
        return view('livewire.user.hardpoints');
    }
}
