<?php

namespace App\Livewire\Admin;
use App\Models\Questions2 as med;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
class Medium extends Component
{
    use Actions;
    use  WithPagination;
    public $answer1, $answer2, $answer3,$answer, $question,$search, $hint;
    public $add_modal = false;
    public function render()
    {
        $search = '%' .$this->search. '%';
        return view('livewire.admin.medium',[
            'quest' => med::where('question', 'like', $search)->paginate(10),
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
             'answer1' => 'required',
             'answer2' => 'required',
             'answer3' => 'required',
             'answer' => 'required',
             'hint' => 'required',

         ]);

      med::create([
            'question' => $this->question,
            'answer1' => $this->answer1,
            'answer2' => $this->answer2,
            'answer3' => $this->answer3,
            'answer' => $this->answer,
            'hint' => $this->hint,
        ]);
        $this->notification()->success(
            $title = 'Question saved!',
            $description = 'Your question was successfully saved'
        );

        $this->add_modal = false;
        $this->reset([
            'question', 'answer1', 'answer2', 'answer3','answer', 'hint'
        ]);
    }
    public function back(){

    }
}
