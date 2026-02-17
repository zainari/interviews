<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form: Add New Client -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Add New Client</h2>
                    <p class="mt-1 text-sm text-gray-600">Enter details to add a client to your company.</p>
                </header>

                <form method="post" action="{{ route('clients.store') }}" class="mt-6 space-y-6 max-w-xl">
                    @csrf
                    <div>
                        <x-input-label for="name" value="Client Name" style="color: black" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                    </div>

                    <div>
                        <x-input-label for="email" value="Client Email" style="color: black" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Save Client</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- List: Clients Table -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Your Company Clients</h2>
                
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-bold">Name</th>
                            <th class="py-2 px-4 font-bold">Email</th>
                            <th class="py-2 px-4 font-bold">Added On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $client->name }}</td>
                                <td class="py-2 px-4">{{ $client->email }}</td>
                                <td class="py-2 px-4 text-sm text-gray-500">{{ $client->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center text-gray-500">No clients found for your company.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>