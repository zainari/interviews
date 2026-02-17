<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create Invoice</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Select Client</label>
                        <select name="client_id" class="w-full rounded shadow-sm border-gray-300">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Invoice Number</label>
                        <x-text-input name="invoice_number" class="w-full" placeholder="e.g. INV-001" />
                    </div>
                    <div class="mb-4">
                        <label>Amount</label>
                        <x-text-input name="amount" type="number" step="0.01" class="w-full" />
                    </div>
                    <div class="mb-4">
                        <label>Due Date</label>
                        <x-text-input name="due_date" type="date" class="w-full" />
                    </div>
                    <x-primary-button>Generate Invoice</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>