<?php

namespace App\Livewire\User;
use App\Models\coins;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Landingpage extends Component
{

    public function render()
    {
        $user = Auth::user();
        $totalMoney = Coins::where('id', $user->id)->sum('money');

        return view('livewire.user.landingpage', [
            'totalMoney' => $totalMoney,
        ]);

    }
}
