{{-- <div>
    <div wire.ignore.self class="flex justify-center md:mt-40 mt-20 md:p-4 p-8 w-full h-11/12">
<span class="bg-green-500 rounded text-white p-8 md:w-4/12 w-11/12 h-64 text-center">
    <div>
        <i class="ri-coins-line text-8xl text-yellow-500"></i>
    </div>

<div class="mt-4">
    <p class="text-xl">YOU GET {{ $score }} POINTS</p>
</div>

<a href="{{ route('user-dashboard') }}"><button class="bg-green-700 text-white p-2 md:w-32  mt-2" >OK</button></a>
</span>
    </div>

</div> --}}
<!-- livewire/user/level1.blade.php -->

<div>

    <div wire.ignore.self class="flex justify-center md:mt-6 mt-20 md:p-0 p-8 w-full h-11/12 gap-4">
        <span class="bg-green-500 rounded text-white p-8 md:w-4/12 w-11/12 h-10/12 text-center">
            <div>
                <i class="ri-coins-line text-8xl text-yellow-500"></i>
            </div>

            {{-- <div class="mt-4">
                @if($score > auth()->user()->coins3 )
                <p class="text-xl">YOU GET {{ $score }} POINTS</p>
            @else
                <p class="text-xl text-red-500">Sorry, your score is lower than your current score.</p>
            @endif

            </div> --}}

            <div class="mt-4">
                @if($score > auth()->user()->coins3 )
                    <p class="text-xl">YOU GET {{ $score }} POINTS</p>
                    @if($score == 200)
                        <p class="text-lg text-green-700">Congratulations! You've earned enough points to receive a certificate.</p>
                       <a href="{{ route('certificate') }}"> <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">Download Certificate</button></a>
                    @endif
                    @else
                    <p class="text-xl text-red-500">Sorry, your score is lower than your current score.</p>
                @endif

            </div>

            <div class="mt-4">

                <ol class="flex flex-col items-start">
                    <p class="text-lg text-blue-700">Correct Answers:</p>
                    @foreach($questions as $key => $question)
                        <li>{{ $key + 1 }}. {{ $question->correctcode }}</li>
                    @endforeach
                </ol>
            </div>
            <a href="{{ route('user-dashboard') }}">
                <button class="bg-green-700 text-white p-2 md:w-32 mt-2">OK</button>
            </a>
        </span>


    </div>





</div>
