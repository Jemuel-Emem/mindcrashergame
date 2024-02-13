<?php

namespace App\Livewire\User;

use Livewire\Component;

class Easypoints extends Component
{
    public $label =false ;
    public $score;
    public $score1;
    public $add_modal = false;
    public function mount($score)
    {
        $user = auth()->user();

        $this->score = $score;

    }


    public function render()
    {

        return view('livewire.user.easypoints');
    }
    public function save(){
        dd("sasa");
       }
}
