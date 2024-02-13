<!-- livewire/user/level1.blade.php -->

<div class="">
     <audio id="song" class="block w-full max-w-md mx-auto" >
        <source src="{{ asset('music/m2.mp3') }}" type="audio/mpeg" loop>
    </audio>
    @if (!$showContent)
    <div class="">
        <x-card title="Read the mechanics">
            <div class="text-start">
                <p>This the game gbashashaisiah</p>
            </div>
            <div class="flex justify-center md:py-0 ">
                <button onclick="startCountdown()" wire:click="toggleContent"  class="bg-green-500 hover:bg-green-600 text-white p-2 rounded md:h-16 h-16 md:w-2/12 w-11/12">Start</button>
            </div>

        </x-card>
    </div>

    @else
    <div>
           <div class="flex justify-center mb-8 text-red-500 text-4xl font-black">
            <div id="countdown"></div>
           </div>
    </div>

        <div class="flex justify-center">
            <label for="" class="text-blue-700 font-light text-2xl">{{ $currentQuestion->question }}</label>
        </div>

        <div class="flex flex-col justify-center text-center mt-10">
            <label for="" class="text-yellow-500 italic">Type the correct answer here</label>
            <x-textarea wire:model="userAnswer" label="Comment" placeholder="{{ $currentQuestion->givencode }}"   class="{ 'border-red-500': isWrongAnswer }"/>

            <div class="mt-4 flex md:justify-center justify-center gap-2">
                <button wire:click="checkCode" class="bg-yellow-500 hover:bg-yellow-600 md:w-40 w-80 h-12 rounded md:mr-0 ">RUN</button>
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

        // Set the duration of the countdown in seconds
        const countdownDuration = 22;

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
