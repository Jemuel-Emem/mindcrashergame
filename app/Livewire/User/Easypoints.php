<?php

namespace App\Livewire\User;

use Livewire\Component;

class Easypoints extends Component
{
    public $label =false ;
    public $score;
    public $score1;
    public $add_modal = false;
    public function mount($score, $score1)
    {
        $user = auth()->user();
        if ($this->score < $user->coins) {
            $label = true;
        }
        $this->score = $score;
        $this->score1 = $score1;

    }


    public function render()
    {

        return view('livewire.user.easypoints');
    }
    public function save(){
        dd("sasa");
       }
}
