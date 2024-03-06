<?php

namespace App\Livewire\Admin;
use App\Models\Questions as question;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
class Questions extends Component
{
    use Actions;
    use  WithPagination;
    public $answer1, $answer2, $answer3,$answer, $question,$search, $hint, $editid;
    public $add_modal = false;
    public $edit_modal = false;
    public function render()
    {
        //return view('livewire.admin.questions');

        $search = '%' .$this->search. '%';
        return view('livewire.admin.questions',[
            'quest' => question::where('question', 'like', $search)->paginate(10),
        ]);
    }
    public function asss()
    {

        $this->resetPage();


    }
    public function back(){

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

      question::create([
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
            'question', 'answer1', 'answer2', 'answer3','answer','hint'
        ]);
    }

    public function edit($id){
        $data = question::where('id', $id)->first();

        if ($data){
           $this->question = $data->question;
           $this->answer1 = $data->answer1;
           $this->answer2 = $data->answer2;
           $this->answer3 = $data->answer3;
           $this->answer = $data->answer;
           $this->hint = $data->hint;
           $this->editid = $data->id;
           $this->edit_modal = true;
        }
           }


           public function submitedit(){
            $data = question::where('id', $this->editid)->first();

            $data->update([
                'question' => $this->question,
                'answer1' => $this->answer1,
                'answer2' => $this->answer2,
                'answer3' => $this->answer3,
                'answer' => $this->answer,
                'hint' => $this->hint,
            ]);

            $this->notification()->success(
                $title = 'Question Update!',
                $description = 'Your question was updated successfully'
            );

            $this->edit_modal = false;


        }

        public function delete($id){
            dd("sasa");
        }

}
