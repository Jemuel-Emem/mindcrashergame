<?php

namespace App\Livewire\User;

use Livewire\Component;

class Score extends Component
{
    public $score;

    public function mount($score)
    {
        $this->score = $score;
    }
    public function render()
    {
        return view('livewire.user.score');
    }

   public function save(){
    dd("sasa");
   }
}
