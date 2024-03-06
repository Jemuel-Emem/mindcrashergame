<div>
    <div>
        <x-card>
            <div class="mb-8 text-center">
                <h1 class="md:text-4xl text-3xl font-bold text-yellow-500">CONGRATULATIONS !</h1>
                <span class="text-4xl font-bold uppercase">{{ Auth::user()->name }}</span>
                <p class="text-xl mt-4">YOU FINISHED THIS LEVEL</p>
            </div>
        </x-card>
    </div>

    <script>

        window.onload = function() {
            fetch('certificate')
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, 'text/html');
                    const bodyContent = doc.body.innerHTML;
                    document.body.innerHTML = bodyContent;
                    window.print();
                })
                .catch(error => {
                    console.error('Error fetching Livewire component content:', error);
                });
        }
    </script>
</div>
