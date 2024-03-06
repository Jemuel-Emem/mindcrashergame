<?php

namespace App\Livewire\User;
use App\Models\Hard as hards;
use App\Models\Mechanics;
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
    public $maxQuestions = 2;
    public $showContent = false;
    public $isWrongAnswer = false;
    public $timer;
    public $seconds = 30;

    public $correctAnswer;
    public $mechanics;
    public $showFullMechanics = false;
    public $position = 0;
    public $clicked = false;
    public function toggle()
    {
        $this->position += 100;
    }
    public function mount()
    {
        $this->mechanics = Mechanics::find(3)->tutorial;
        $this->questions = hards::orderByRaw('RAND()')->limit($this->maxQuestions)->get();

    }

    public function toggleContent()
    {


       $this->showContent = !$this->showContent;

    }
    public function render()
    {

        if ($this->currentQuestionIndex >= $this->maxQuestions || !isset($this->questions[$this->currentQuestionIndex])) {
            $user = auth()->user();

            if ($this->score > $user->coins3) {
                UserCoins::updateOrCreate(
                    ['id' => $user->id],
                    ['coins3' => $this->score]
                );
            }

            return view('livewire.User.hardpoints', [
                'score3' => $this->score,
                'correctAnswer' => $this->correctAnswer,
            ]);
        }


        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $this->correctAnswer = $currentQuestion->correctcode;

        return view('livewire.user.hard', compact('currentQuestion'));

    }

    public function checkCode()
{
    $correctAnswer = $this->questions[$this->currentQuestionIndex]->correctcode;

    if ($this->userAnswer === $correctAnswer) {

        $this->score += 10;
        $this->currentQuestionIndex++;
    } else {

        $this->dialog()->error(
            $title = 'Error !!!',
            $description = 'Please check you syntax and try again'
        );
    }
    $this->userAnswer = '';
}

public function deduct($id){
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

// public function nextQuestion()
//     {


//         $correctAnswer = $this->questions[$this->currentQuestionIndex]->correctcode;

//     if ($this->userAnswer === $correctAnswer) {

//         $this->score += 10;
//         $this->currentQuestionIndex++;
//     }

//     if ($this->currentQuestionIndex >= $this->maxQuestions) {
//         $this->render();
//     }
//     $this->userAnswer = '';
//     }

public function nextQuestion()
{
    // Increment the current question index
    $this->currentQuestionIndex++;

    // Check if the current question index exceeds the maximum questions
    if ($this->currentQuestionIndex >= $this->maxQuestions) {
        // If there are no more questions, render the score page
        return $this->render();
    }

    // Reset the user's answer for the next question
    $this->userAnswer = '';
}


    }

