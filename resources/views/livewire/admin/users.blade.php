<div>
    <x-alert class="bg-green-700 text-green-100 p-4" />

    <div class="flex gap-2 mt-2">
        <x-input label="" placeholder="Search..." wire:model="search" />
    <div>
        <x-button  label="Search " wire:click.prevent="asss" class="bg-green-700 text-white hover:bg-green-900" />
    </div>
    </div>
    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                      Name
                     </th>
                    <th scope="col" class="px-6 py-3">
                      Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Totalcoins
                    </th>

                </tr>
            </thead>
            <tbody>
                 @forelse($users as $q)
                <tr>
                    <td class="px-6 py-4">{{ $q->name }}</td>
                    <td class="px-6 py-4">{{ $q->email }}</td>
                    <td class="px-6 py-4">{{ $q->coins1 + $q->coins2 + $q->coins3 }}</td>

                </tr>
                @empty
                <tr>
                    <td colspan="10">No data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div>
         {{ $users->links() }}
        </div>
    </div>




</div>

