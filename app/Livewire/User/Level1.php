<?php

namespace App\Livewire\User;
use App\Models\Questions as Modelquestion;
use App\Models\User as UserCoins;
use Livewire\Component;
use WireUi\Traits\Actions;
class Level1 extends Component
{
    use Actions;
    public $questions;
    public $currentQuestionIndex = 0;
    public $userAnswer = '';
    public $score = 0;
    public $maxQuestions = 2;
    public $showContent = false;

    public $timer;
    public $seconds = 30;

    public $correctAnswer;
    public function mount()
    {

        $this->questions = Modelquestion::inRandomOrder()->limit($this->maxQuestions)->get();
    }



    public function render()
    {

        if ($this->currentQuestionIndex >= $this->maxQuestions) {
        //      $user = auth()->user(); // Get the authenticated user

        //      UserCoins::updateOrCreate(
        //         ['id' => $user->id],
        //         ['coins1' => $user->coins1 + $this->score]
        //    );
             $user = auth()->user();
             if ($this->score > $user->coins1) {

                 // Save the user's new score
                 UserCoins::updateOrCreate(
                     ['id' => $user->id],
                     ['coins1' => $this->score]
               );
            }
             else{
              dd("sasa");
             }

            return view('livewire.User.easypoints', [
                'score' => $this->score,
                'correctAnswer' => $this->correctAnswer,
            ]);
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];


        $this->correctAnswer = $currentQuestion->answer;

        return view('livewire.user.level1', compact('currentQuestion'));
    }



    public function nextQuestion()
    {

         // Validate answer or perform any other necessary logic here
         $correctAnswer = $this->questions[$this->currentQuestionIndex]->answer;

         // Compare the user's answer to the correct answer
         if ($this->userAnswer === $correctAnswer) {
             $this->score += 10;
         }

         // Move to the next question
         $this->currentQuestionIndex++;

         // If there are no more questions, render the results
         if ($this->currentQuestionIndex >= $this->maxQuestions) {
             $this->render();
         }

         // Clear user's previous answer
         $this->userAnswer = '';

    }



    public function toggleContent()
    {

       $this->showContent = !$this->showContent;

    }
    public function selectAnswer($selectedAnswer)
    {

        $this->userAnswer = $selectedAnswer;
    }
    // public function saveScoreToUser()
    // {

    //      $user = UserCoins::where('name', 'coins')->first();

    //     if ($user) {

    //         $user->update(['coins' => $this->score]);
    //  }

    // }


}
