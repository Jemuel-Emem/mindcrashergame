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
                       Given code
                    </th>
                    <th scope="col" class="px-6 py-3">
                      Correct Code
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
                    <td class="px-6 py-4">{{ $q->givencode }}</td>
                    <td class="px-6 py-4">{{ $q->correctcode }}</td>
                    <td class="px-6 py-4">{{ $q->hint }}</td>
                   <td class="px-6 py-4 flex gap-2 mt-4 justify-center">
                        <x-button class="w-16 h-6" label="edit" icon="pencil-alt" wire:click="edit({{ $q->id }})" positive />
                        <x-button class="w-16 h-6" label="delete" icon="pencil-alt" wire:click="delete({{ $q->id }})" negative />
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
                <x-textarea wire:model="question" label="Question" placeholder="Write question here" />
                <x-textarea wire:model="givencode" label="Given code" placeholder="Write given code here" />
                <x-textarea wire:model="correctcode" label="Correct Code" placeholder="Write the correct code here" />
                <p class="text-blue-700">Write  hint for question</p>
                <x-input label="Hint" placeholder="write hint here" wire:model="hint" />
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  />
                    <x-button primary label="Submit" wire:click="submit" spinner="submit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>


    {{-- <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Model">
            <div class="space-y-3">
              <div class="flex gap-2">
                <x-input label="Name" wire:model="name" placeholder="" />
                <x-input label="Age" placeholder="" wire:model="age" />
              </div>
                <x-input label="Address" placeholder="" wire:model="address" />
                <x-input label="Contact" placeholder="" wire:model="contact" />
                <x-input label="Number" placeholder="" wire:model="number" />
                <x-input label="Grade" wire:model="grade" placeholder="" />
                <x-input label="Strand and Course" wire:model="strand_course" placeholder="" />
                <x-input label="Section" placeholder="" wire:model="section" />


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  wire:click="back"/>
                    <x-button primary label="Submit" wire:click="submitEdit" spinner="submitEdit" />
                </div>
            </x-slot>
        </x-card>
    </x-modal> --}}
</div>

