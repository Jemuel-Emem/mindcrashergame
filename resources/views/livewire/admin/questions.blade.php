<div>
    <x-alert class="bg-green-700 text-green-100 p-4" />
    <x-button label="Add Questions" dark icon="plus" wire:click="$set('add_modal', true)" />
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
                        Question
                     </th>
                    <th scope="col" class="px-6 py-3">
                       Answer # 1
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Answer # 2
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Answer # 3
                     </th>
                     <th scope="col" class="px-6 py-3">
                      Correct Answer
                     </th>
                     <th scope="col" class="px-6 py-3">
                       Hint
                       </th>

                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                 @forelse($quest as $q)
                <tr>
                    <td class="px-6 py-4">{{ $q->question }}</td>
                    <td class="px-6 py-4">{{ $q->answer1 }}</td>
                    <td class="px-6 py-4">{{ $q->answer2 }}</td>
                    <td class="px-6 py-4">{{ $q->answer3 }}</td>
                    <td class="px-6 py-4">{{ $q->answer }}</td>
                    <td class="px-6 py-4">{{ $q->hint }}</td>



                   <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                        <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $q->id }})" positive />
                        <x-button class="w-16 h-6" label="delete" icon="pencil-alt"
                            x-on:confirm="{
                                title: 'Sure Delete?',
                                icon: 'warning',
                                method: 'delete',
                                params: {{ $q->id }}
                            }" negative />

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
        <x-card title="Add Questions">
            <div class="space-y-3">
                <x-input label="Question " placeholder="" wire:model="question" />
                <x-input label="Choice # 1" placeholder="" wire:model="answer1" />
                <x-input label="Choice # 2" wire:model="answer2" placeholder="" />
                <x-input label="Choice # 3" placeholder="" wire:model="answer3" />
                <p class="text-blue-700">Write  the correct answer</p>
                <x-input label="Answer" placeholder="" wire:model="answer" />
                <p class="text-blue-700">Write  hint for question</p>
                <x-input label="Hint" placeholder="" wire:model="hint" />

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" wire:click="back" />
                    <x-button primary label="Submit" wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


     <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Model">
            <div class="space-y-3">
                <x-input label="Question " placeholder="" wire:model="question" />
                <x-input label="Choice # 1" placeholder="" wire:model="answer1" />
                <x-input label="Choice # 2" wire:model="answer2" placeholder="" />
                <x-input label="Choice # 3" placeholder="" wire:model="answer3" />
                <p class="text-blue-700">Write  the correct answer</p>
                <x-input label="Answer" placeholder="" wire:model="answer" />
                <p class="text-blue-700">Write  hint for question</p>
                <x-input label="Hint" placeholder="" wire:model="hint" />

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  wire:click="back"/>
                    <x-button primary label="Submit" wire:click="submitEdit" spinner="submitEdit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>

