<?php

namespace App\Livewire\Admin;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use App\Models\Mechanics as mech;
use Livewire\Component;

class MechanicsTutorial extends Component
{
    use Actions;
    use  WithPagination;

    public $levels, $mechanics,$tutorial,$search, $editid;
    public $add_modal = false;
    public $edit_modal = false;


    public function render()
    {

        $search = '%' .$this->search. '%';
        return view('livewire.admin.mechanics-tutorial',[
            'quest' => mech::where('levels', 'like', $search)->paginate(3),
        ]);

    }

    public function submit(){
        sleep(2);

         $this->validate([
             'levels' => 'required',
             'mechanics' => 'required',
             'tutorial' => 'required',

         ]);

      mech::create([
            'Levels' => $this->levels,
            'mechanics' => $this->mechanics,
            'tutorial' => $this->tutorial,

        ]);
        $this->notification()->success(
            $title = 'Instructions saved!',
            $description = 'Your instructions was successfully saved'
        );

        $this->add_modal = false;
        $this->reset([
            'levels', 'mechanics', 'tutorial',
        ]);
    }


    public function edit($id){
 $data = mech::where('id', $id)->first();

 if ($data){
    $this->levels = $data->Levels;
    $this->mechanics = $data->mechanics;
    $this->tutorial = $data->tutorial;
    $this->editid = $data->id;
    $this->edit_modal = true;
 }
    }


    public function submitedit(){
        $data = mech::where('id', $this->editid)->first();

        $data->update([
            'levels' => $this->levels,
            'mechanics' => $this->mechanics,
            'tutorial' => $this->tutorial,
        ]);

        $this->notification()->success(
            $title = 'Instructions Update!',
            $description = 'Your instructions was updated successfully'
        );

        $this->edit_modal = false;


    }


}
