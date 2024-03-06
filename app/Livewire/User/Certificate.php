<?php

namespace App\Livewire\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Dompdf\Dompdf;
class Certificate extends Component
{
    public $certificateContent;

    public function render()
    {
        return view('livewire.user.certificate');
    }



}
