<?php

namespace App\Livewire\User;
use App\Models\Questions2 as Modelquestion;
use App\Models\Coins as coins;
use App\Models\Mechanics;
use App\Models\User as UserCoins;
use Livewire\Component;
use WireUi\Traits\Actions;
class Level2 extends Component
{
    use Actions;
    public $questions;
    public $currentQuestionIndex = 0;
    public $userAnswer = '';
    public $score = 0;
    public $maxQuestions = 1;
    public $timer;
    public $seconds = 30;
    public $clicked = false;
    public $coinss;
    public $correctAnswer;
    public $showContent = false;

    public $mechanics;
    public $showFullMechanics = false;
    public $position = 0;
    public function toggle()
    {
        $this->position += 100;
    }
    public function mount()
    {
        $this->mechanics = Mechanics::find(2)->tutorial;

        $this->questions = Modelquestion::orderByRaw('RAND()')->limit($this->maxQuestions)->get();
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

        $this->clicked = false;
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

    public function deduct($id){
        $this->clicked = true;
        $deductionAmount = 5;

        $userCoins = UserCoins::find($id);

        if ($userCoins) {
            if ($userCoins->coins1 >= $deductionAmount) {
                $userCoins->coins1 -= $deductionAmount;
                $userCoins->save();

                $currentQuestion = $this->questions[$this->currentQuestionIndex];
                $randomHint = $currentQuestion->hint;

                $this->dialog()->success(
                    $title = 'Success',
                    $description = "Your gems have been deducted. Here's a hint: $randomHint"
                );
            }

            else if ($userCoins->coins2 >= $deductionAmount) {
                $userCoins->coins2 -= $deductionAmount;
                $userCoins->save();

                $currentQuestion = $this->questions[$this->currentQuestionIndex];
                $randomHint = $currentQuestion->hint;

                $this->dialog()->success(
                    $title = 'Success',
                    $description = "Your gems have been deducted. Here's a hint: $randomHint"
                );
            }
            else if ($userCoins->coins3 >= $deductionAmount) {
                $userCoins->coins3 -= $deductionAmount;
                $userCoins->save();

                $currentQuestion = $this->questions[$this->currentQuestionIndex];
                $randomHint = $currentQuestion->hint;

                $this->dialog()->success(
                    $title = 'Success',
                    $description = "Your gems have been deducted. Here's a hint: $randomHint"
                );
            }

            else {
                $this->dialog()->error(
                    $title = 'Insufficient Gems',
                    $description = 'You do not have enough gems to perform this action.'
                );
            }
        } else {
            $this->dialog()->error(
                $title = 'Error',
                $description = 'User not found.'
            );
        }

        return redirect()->back();
    }
}
