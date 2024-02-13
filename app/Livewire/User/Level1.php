<?php

namespace App\Livewire\User;
use Illuminate\Support\Facades\Auth;
use App\Models\User as user;
use App\Models\Questions as Modelquestion;
use App\Models\Coins as UserCoins;

use Livewire\Component;
use WireUi\Traits\Actions;

class Level1 extends Component
{
    use Actions;

    public $questions;
    public $currentQuestionIndex = 0;
    public $userAnswer = '';
    public $score = 0;
    public $maxQuestions = 5;
    public $showContent = false;
    public $correctAnswer;
    public $amount;

    public function mount()
    {
        $this->questions = Modelquestion::inRandomOrder()->limit($this->maxQuestions)->get();
    }

    public function render()
    {
        if ($this->currentQuestionIndex >= $this->maxQuestions || !isset($this->questions[$this->currentQuestionIndex])) {
            $user = auth()->user();
            if ($this->score > $user->coins2) {

                user::updateOrCreate(
                    ['id' => $user->id],
                    ['coins1' => $this->score]
                );
            }

            return view('livewire.User.easypoints', [
                'score1' => $this->score,
                'correctAnswer1' => $this->correctAnswer,
            ]);
        }

        $currentQuestion = $this->questions[$this->currentQuestionIndex];
        $this->correctAnswer = $currentQuestion->answer;

        return view('livewire.user.level1', compact('currentQuestion'));
    }

    public function nextQuestion()
    {
        $correctAnswer = $this->questions[$this->currentQuestionIndex]->answer;
        if ($this->userAnswer === $correctAnswer) {
            $this->score += 10;
        }

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

    public function saveScoreToUser()
    {
        // Assuming you have a user named 'coins' in the users table
        $user = UserCoins::where('name', 'coins')->first();

        if ($user) {
            // Save the user's score to the 'coins' user
            $user->update(['coins' => $this->score]);
        }
    }

    public function deduct($id){
        $deductionAmount = 5;

        $userCoins = User::find($id);

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

