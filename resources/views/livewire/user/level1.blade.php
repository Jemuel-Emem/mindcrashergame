<!-- livewire/user/level1.blade.php -->
<div class="h-cover">
    <div class="">
        <audio id="song" class="block w-full max-w-md mx-auto" >
            {{-- <source src="{{ asset('music/m2.mp3') }}" type="audio/mpeg" loop> --}}
        </audio>
        @if (!$showContent)
        <div class="">
            <x-card title="Read the mechanics">
                <div class="text-start flex flex-col">
                    @php
                    $mechanicsSubstring = substr($mechanics, $position, 500);
                    $mechanicsLines = str_split($mechanicsSubstring, 200); // Split into lines of 100 characters
                    echo implode("<br>", $mechanicsLines); // Concatenate lines with <br> tags
                @endphp

                @if (strlen($mechanics) > ($position + 500))
                    <button wire:click="toggle" class="text-blue-500">
                        Read More
                    </button>
                @endif
                </div>

               @if (strlen($mechanics) < ($position + 500))
               <div class="flex justify-center md:mt-40 mt-20">
                <button onclick="startCountdown()" wire:click="toggleContent"  class="bg-green-500 hover:bg-green-600 text-white p-2 rounded md:h-16 h-16 md:w-2/12 w-11/12">Start</button>
            </div>
               @endif
            </x-card>
        </div>

        @else

        <div class="flex md:flex-row flex-col justify-around mb-4 text-center">
            <div class="md:mt-8 mt-2">
                <button class="bg-yellow-500 hover:bg-yellow-400 text-white p-2 rounded-lg w-32 " onclick="toggleMusic()">ON/OFF</button>
            </div>
            @if (!$clicked)
            <div x-data="{ title: 'Are you sure? It will deduct 5 coins' }">
                <i class="ri-lightbulb-fill md:text-8xl text-6xl text-yellow-500 hover:text-yellow-400"
                    x-on:confirm="{
                        title,
                        icon: 'warning',
                        method: 'deduct',
                        params: {{ auth()->user()->id }}
                    }"></i>
            </div>
            @endif
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

            <div class="flex flex-col justify-center text-center md:mt-10 mt-2">

                <div >
                    <x-input wire:model="userAnswer" label="Select the correct answer" placeholder="User's first name" disabled/>
                    {{-- <input  type="text" name="" id="" placeholder="Type answer here" class="md:w-4/12 w-8/12"> --}}
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

function toggleMusic() {
    if (isMusicPlaying) {
        backgroundMusic.pause();
        isMusicPlaying = false;
    } else {
        backgroundMusic.play();
        isMusicPlaying = true;
    }
}
</script>
