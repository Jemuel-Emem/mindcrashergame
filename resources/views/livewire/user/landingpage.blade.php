<div>
    <div class="flex justify-between">
        <div class="mt-4">
            <i class="ri-copper-diamond-fill text-green-700 md:text-4xl text-4xl"></i>
            <label for="" class="font-black md:text-4xl text-4xl text-green-500">{{ $totalCoins }}</label>
        </div>
        @if ($totalCoins >= 0 && $totalCoins <= 100)
        <div>
            <img src="{{ asset('images/badge11.png') }}" alt="Badge 11" class="md:w-20 w-20 md:h-20 h-20">
        </div>
        @elseif ($totalCoins > 100 && $totalCoins <= 200)
        <div>
            <img src="{{ asset('images/badge22.png') }}" alt="Badge 22" class="md:w-20 w-20 md:h-20 h-20">
        </div>
        @elseif ($totalCoins > 200 && $totalCoins <= 350)
        <div>
            <img src="{{ asset('images/badge33.png') }}" alt="Badge 33" class="md:w-20 w-20 md:h-20 h-20">
        </div>
        @elseif ($totalCoins > 350 && $totalCoins <= 500)
        <div>
            <img src="{{ asset('images/badge44.png') }}" alt="Badge 44" class="md:w-20 w-20 md:h-20 h-20">
        </div>
        @elseif ($totalCoins > 500 && $totalCoins <= 600)
        <div>
            <img src="{{ asset('images/badge55.png') }}" alt="Badge 55" class="md:w-20 w-20 md:h-20 h-20">
        </div>
        @endif
    </div>
    <div class="p-20 relative">
        <div class="md:absolute right-30 md:left-80">
            <div class="flex flex-col">
                <label for="" class="text-bermuda font-black md:text-4xl text-lg text-center">ARE YOU READY TO BREAK YOUR MIND?</label>
                <div class="flex justify-center">
                    <img src="{{ asset('images/logonamon.gif') }}" alt="Logo" class="md:w-80 md:h-80 md:mt-2">
                </div>
            </div>
        </div>
        <div class="flex md:justify-end justify-center md:mt-0 mt-10">
            <span class="flex flex-col gap-4">
                <a href="{{ route('easy') }}"><button class="text-white p-2 rounded bg-green-400 hover:bg-green-500 w-72 h-16">Easy</button></a>
                <a href="{{ route('medium') }}"><button class="text-white p-2 rounded bg-blue-400 hover:bg-blue-500 w-72 h-16">Medium</button></a>
                <a href="{{ route('hard') }}"><button class="text-white p-2 rounded bg-amber-400 hover:bg-amber-500 w-72 h-16">Hard</button></a>
            </span>
        </div>
    </div>
</div>
