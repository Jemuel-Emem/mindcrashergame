<div>
    <x-alert class="bg-green-700 text-green-100 p-4" />
    <x-button label="Add Instructions" dark icon="plus" wire:click="$set('add_modal', true)" />

    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        #
                     </th>
                    <th scope="col" class="px-6 py-3">
                      Levels
                    </th>
                    <th scope="col" class="px-6 py-3">
                     Mechanics
                    </th>
                    <th scope="col" class="px-6 py-3">
                    Tutorial Facility
                     </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                  @forelse($quest as $q)
                <tr>
                    <td class="px-6 py-4">{{ $q->id }}</td>
                    <td class="px-6 py-4">{{ $q->Levels }}</td>
                    <td class="px-6 py-4">{{ $q->mechanics }}</td>
                    <td class="px-6 py-4">{{ $q->tutorial }}</td>

                   <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                        <x-button class="w-16 h-6" label="edit" icon="pencil-alt"  wire:click="edit({{ $q->id }})" positive />

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10">No data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div>
         {{ $quest->links() }}
        </div>
    </div>



    <x-modal wire:model.defer="add_modal">
        <x-card title="Add Instructions">
            <div class="space-y-3">
                <x-input label="What level is this? " placeholder="" wire:model="levels" />
                <x-textarea label="Mechanics" placeholder="" wire:model="mechanics" />
                <x-textarea label="Tutorial Facility" placeholder="" wire:model="tutorial" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  negative/>
                    <x-button positive label="Submit" wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    <x-modal wire:model.defer="edit_modal">
        <x-card title="Add Instructions">
            <div class="space-y-3">
                <x-input label="What level is this? " placeholder="" wire:model="levels" />
                <x-textarea label="Mechanics" placeholder="" wire:model="mechanics" />
                <x-textarea label="Tutorial Facility" placeholder="" wire:model="tutorial" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  negative/>
                    <x-button positive label="Submit" wire:click="submitedit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>

