<?php

namespace App\Livewire\Admin;
use App\Models\Hard as q;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Livewire\Component;

class Hard extends Component
{
    use Actions;
    use  WithPagination;
    public $givencode, $correctcode,$question,$search, $hint;
    public $add_modal = false;
    public function render()

    {
        $search = '%' .$this->search. '%';
        return view('livewire.admin.hard',[
            'quest' => q::where('question', 'like', $search)->paginate(10),
        ]);

    }
    public function asss()
    {

        $this->resetPage();
    }
    public function submit(){
        sleep(2);

         $this->validate([
             'question' => 'required',
             'givencode' => 'required',
             'correctcode' => 'required',
             'hint' => 'required',
         ]);

      q::create([
            'question' => $this->question,
            'givencode' => $this->givencode,
            'correctcode' => $this->correctcode,
            'hint' => $this->hint,
        ]);
        $this->notification()->success(
            $title = 'Question saved!',
            $description = 'Your question was successfully saved'
        );

        $this->add_modal = false;
        $this->reset([
            'question', 'givencode', 'correctcode', 'hint',
        ]);
    }


}
