<div class="p-2">
    <div class="flex justify-center">
        <h1 class="md:text-6xl text-2xl font-black text-green-600">LEADERBOARD</h1>
    </div>
    <div class="relative overflow-x-auto mt-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-yellow-400 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-lg text-white">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-white">
                        COINS
                    </th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($result as $user)
                    @if ($user->name !== 'ADMINISTRATOR')
                        <tr class="bg-white ">
                            <th scope="row" class="uppercase px-6 py-4 font-bold text-green-500 whitespace-nowrap dark:text-white ">
                                <i class="ri-shield-user-fill"></i>  {{ $user->name }}
                            </th>
                            <td class="px-6 py-4 text-green-500 text-center text-xl relative ">
                                <span>{{ $user->total_score }}</span>
                                <span class="absolute top-0 right-0">
                                    @if ($user->total_score >= 0 && $user->total_score <= 100)
                                        <img src="{{ asset('images/badge11.png') }}" alt="Badge 11" class="w-8 h-8 mt-3">
                                    @elseif ($user->total_score > 100 && $user->total_score <= 200)
                                        <img src="{{ asset('images/badge22.png') }}" alt="Badge 22" class="w-8 h-8 mt-3">
                                    @elseif ($user->total_score > 200 && $user->total_score <= 350)
                                        <img src="{{ asset('images/badge33.png') }}" alt="Badge 33" class="w-8 h-8 mt-3">
                                    @elseif ($user->total_score > 350 && $user->total_score <= 500)
                                        <img src="{{ asset('images/badge44.png') }}" alt="Badge 44" class="w-8 h-8 mt-3">
                                    @elseif ($user->total_score > 500 && $user->total_score <= 600)
                                        <img src="{{ asset('images/badge55.png') }}" alt="Badge 55" class="w-8 h-8 mt-3">
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
