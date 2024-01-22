<?php

namespace App\Livewire\User;
use App\Models\Questions2 as Modelquestion;
use App\Models\User as UserCoins;
use Livewire\Component;

class Level2 extends Component
{
    public $questions;
    public $currentQuestionIndex = 0;
    public $userAnswer = '';
    public $score = 0;
    public $maxQuestions = 1;
    public $timer;
    public $seconds = 30;

    public $correctAnswer;
    public $showContent = false;
    public function mount()
    {

        $this->questions = Modelquestion::inRandomOrder()->limit($this->maxQuestions)->get();
    }
    public function render()
    {
        if ($this->currentQuestionIndex >= $this->maxQuestions) {
            $user = auth()->user();
             if ($this->score > $user->coins2) {

                 // Save the user's new score
                 UserCoins::updateOrCreate(
                     ['id' => $user->id],
                     ['coins2' => $this->score]
               );
            }
             else{
              dd("sasa");
             }


            return view('livewire.User.easypoints', [
                'score1' => $this->score,
                'correctAnswer1' => $this->correctAnswer,
            ]);
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $this->correctAnswer = $currentQuestion->answer;
        return view('livewire.user.level2', compact('currentQuestion') );
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
    public function selectAnswer($selectedAnswer)
    {

        $this->userAnswer = $selectedAnswer;
    }
    public function saveScoreToUser()
    {
        // Assuming you have a user named 'coins' in the users table
        $user = UserCoins::where('name', 'coins')->first();

        if ($user) {
            // Save the user's score to the 'coins' user
            $user->update(['coins' => $this->score]);
        }
    }

    public function toggleContent()
    {

       $this->showContent = !$this->showContent;

    }
}
