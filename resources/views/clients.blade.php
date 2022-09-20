<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg">List of your clients</h3>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($clients as $client)
                        <div class="py-3 text-gray-900">
                            <h3 class="text-lg text-gray-500">{{ $client->name }}</h3>
                            <p><b>ID:</b> {{ $client->id }}</p>
                            <p><b>Secret:</b> {{ $client->secret }}</p>
                            <p><b>Redirect URI:</b> {{ $client->redirect }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg">Create a new client</h3>
                </div>

                <div class="p-6 bg-white">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-1/3" type="text" name="name" :value="old('name')" placeholder="Client name" required />
                </div>

                <div class="p-6 bg-white">
                    <x-input-label for="redirect" :value="__('Redirect URI')" />
                    <x-text-input id="redirect" class="block mt-1 w-1/3" type="text" name="redirect" :value="old('client_redirect_uri')" placeholder="http://app-domain/callback" required />
                </div>

                <div class="p-6 bg-white border-b border-gray-200">
                    <x-primary-button onclick="register()">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function register() {
        const name = document.getElementById('name').value;
        const redirect = document.getElementById('redirect').value;

        if (!name || !redirect) {
            return;
        }

        axios.post('/oauth/clients', {
            name,
            redirect
        }).then(response => {
            console.log(response.data);
            if (confirm('Client created successful!')) {
                window.location.reload();
            }
        }).catch (response => {
            console.log(response);
        });
    }
</script>
