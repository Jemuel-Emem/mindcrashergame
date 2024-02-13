<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
//use App\Livewire\User\Level1;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware([

    ])->group(function () {
         Route::get('/dashboard', function () {
           if (auth()->user()->is_admin == 1) {
            return redirect()->route('Admindashboard');
           }else{
            return redirect()->route('user-dashboard');
           }
         })->name('userdashboard');

    });

    Route::prefix('admin')->middleware('admin')->group(function(){
        Route::get('/Admindashboard', function(){
            return view('admin.index');
        })->name('Admindashboard');
        Route::get('/Medium', function(){
            return view('Admin.Medium');
        })->name('Medium');
        Route::get('/Easy', function(){
            return view('Admin.Easy');
        })->name('Easy');

        Route::get('/Hard', function(){
            return view('Admin.Hard');
        })->name('Hard');
     });

     Route::prefix('user')->middleware('user')->group(function(){
        Route::get('/dashboard', function(){
               return view('user.index');
           })->name('user-dashboard');

           Route::get('/easy', function(){
            return view('User.easy');
        })->name('easy');

        Route::get('/medium', function(){
            return view('User.medium');
        })->name('medium');

        Route::get('/Hard', function(){
            return view('User.Hard');
        })->name('hard');

        // Route::get('/results', function(){
        //     return view('User.result');
        // })->name('results');

    //       Route::get('/dashboard', function(){
    //         return view('User.result');
    //  })->name('results');
      // Route::get('/quiz/results', [Level1::class, 'ShowResults'])->name('quiz.results');

        });


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
require __DIR__.'/auth.php';

