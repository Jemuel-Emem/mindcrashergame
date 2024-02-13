<?php

namespace App\Livewire\User;
use App\Models\Questions2 as Modelquestion;
use App\Models\Coins as coins;
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

    public $coinss;
    public $correctAnswer;
    public $showContent = false;
    public function mount()
    {

        $this->questions = Modelquestion::inRandomOrder()->limit($this->maxQuestions)->get();
    }
    public function render()
    {
        if ($this->currentQuestionIndex >= $this->maxQuestions || !isset($this->questions[$this->currentQuestionIndex])) {
            $user = auth()->user();
            if ($this->score > $user->coins2) {

                UserCoins::updateOrCreate(
                    ['id' => $user->id],
                    ['coins2' => $this->score]
                );
            }

            return view('livewire.User.Mediumpoints', [
                'score2' => $this->score,
                 'correctAnswer2' => $this->correctAnswer,
            ]);

        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $this->correctAnswer = $currentQuestion->answer;
        return view('livewire.user.level2', compact('currentQuestion'));
    }
    public function nextQuestion()
    {


         $correctAnswer = $this->questions[$this->currentQuestionIndex]->answer;
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
