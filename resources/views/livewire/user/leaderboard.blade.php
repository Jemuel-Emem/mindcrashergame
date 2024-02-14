
<div>


<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 rounded-s-lg">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Score
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $user)
                @if ($user->name !== 'ADMINISTRATOR')
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->total_score }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

</div>
