<!-- livewire/user/level1.blade.php -->

<div class="">
    <audio id="song" class="block w-full max-w-md mx-auto" >
        {{-- <source src="{{ asset('music/m2.mp3') }}" type="audio/mpeg" loop> --}}
    </audio>
    @if (!$showContent)
    <div class="">
        <x-card title="Read the mechanics">
            <div class="text-start">
                <p>This the game gbashashaisiah</p>
            </div>
            <div class="flex justify-center md:py-0 py-60">
                <button onclick="startCountdown()" wire:click="toggleContent"  class="bg-green-500 hover:bg-green-600 text-white p-2 rounded md:h-16 h-16 md:w-2/12 w-11/12">Start</button>
            </div>

        </x-card>
    </div>

    @else
    <div class="flex justify-center mb-4">
       <div  x-data="{ title: 'are you sure?, it will deduct 5 coins' }">
        <i class="ri-lightbulb-fill text-8xl text-yellow-500 hover:text-yellow-400"  x-on:confirm="{
            title,
            icon: 'warning',
            method: 'deduct',
            params: {{ auth()->user()->id }}
        }"></i>
        </div>
    </div>
    <div>
           <div class="flex justify-center mb-8 text-red-500 text-4xl font-black">
            <div id="countdown"></div>
           </div>
    </div>

        <div class="flex justify-center">
            <label for="" class="text-blue-700 font-light text-2xl">{{ $currentQuestion->question }}</label>
        </div>

        <div class="flex md:flex-row flex-col md:justify-center md:mr-0 ml-18  gap-6 mt-4">
            @foreach(['answer1', 'answer2', 'answer3'] as $answer)
            <button wire:click="selectAnswer('{{ $currentQuestion->$answer }}')" class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded md:h-16 h-16 md:w-2/12 w-12/12">{{ $currentQuestion->$answer }}</button>

            @endforeach
        </div>

        <div class="flex flex-col justify-center text-center mt-10">
            <label for="" class="text-yellow-500 italic">Type the correct answer here</label>
            <div>
                <input wire:model="userAnswer" type="text" name="" id="" placeholder="Type answer here" class="md:w-4/12 w-8/12">
            </div>

            <div class="mt-4 flex md:justify-center justify-center">
                <button wire:click="nextQuestion" class="bg-yellow-500 hover:bg-yellow-600 md:w-40 w-80 h-12 rounded md:mr-0 ">Next</button>
            </div>
        </div>
    @endif

</div>

<script>
const backgroundMusic = document.getElementById("song");
let isMusicPlaying = false;

function startCountdown() {
    if (!isMusicPlaying) {
        backgroundMusic.play();
        isMusicPlaying = true;
    }


    const countdownDuration = 50;

    // Calculate the end time
    const countDownDate = new Date().getTime() + countdownDuration * 1000;

    // Function to update the countdown
    function updateCountdown() {
        // Get the current date and time
        const now = new Date().getTime();

        // Calculate the remaining time
        const distance = countDownDate - now;

        // Ensure that the countdown does not go below zero
        const seconds = Math.max(0, Math.floor(distance / 1000));

        // Display the countdown
        document.getElementById("countdown").innerHTML = `${seconds}s`;

        // If the countdown is over, proceed to another view
        if (distance <= 0) {
            clearInterval(countdownInterval);
            if (isMusicPlaying) {
                backgroundMusic.pause();
                isMusicPlaying = false;
            }
            // Add your logic to proceed to another view here
            window.location.href = '{{ route('user-dashboard') }}';
        }
    }

    // Update the countdown every 1 second
    const countdownInterval = setInterval(updateCountdown, 1000);
    updateCountdown();
}


</script>
