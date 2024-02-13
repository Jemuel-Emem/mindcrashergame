<?php

namespace App\Livewire\User;
use App\Models\Hard as hards;
use App\Models\User as UserCoins;
use WireUi\Traits\Actions;
use Livewire\Component;

class Hard extends Component
{
    use Actions;
    public $questions;
    public $currentQuestionIndex = 0;
    public $userAnswer = '';
    public $score = 0;
    public $maxQuestions = 3;
    public $showContent = false;
    public $isWrongAnswer = false;
    public $timer;
    public $seconds = 30;

    public $correctAnswer;

    public function mount()
    {

        $this->questions = hards::inRandomOrder()->limit($this->maxQuestions)->get();

    }

    public function toggleContent()
    {


       $this->showContent = !$this->showContent;

    }
    public function render()
    {
       
        if ($this->currentQuestionIndex >= $this->maxQuestions) {
            $user = auth()->user();

            if ($this->score > $user->coins1) {
                UserCoins::updateOrCreate(
                    ['id' => $user->id],
                    ['coins1' => $this->score]
                );
            }

            return view('livewire.User.easypoints', [
                'score' => $this->score,
                'correctAnswer' => $this->correctAnswer,
            ]);
        }

        $this->questions = hards::inRandomOrder()->limit($this->maxQuestions)->get();
        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $this->correctAnswer = $currentQuestion->answer;

        return view('livewire.user.hard', compact('currentQuestion'));

    }

    public function checkCode(){
        $correctAnswer = $this->questions[$this->currentQuestionIndex]->correctcode;

        if ($this->userAnswer === $correctAnswer) {

            $this->currentQuestionIndex++;
            $this->score += 10;


        }

        else{
            $this->dialog()->error(
                $title = 'Error !!!',
                $description = 'Please Check Your Code'
            );

        }



    }
}
