<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
            <a href="{{ route('invoices.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Create New Invoice</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-2">#</th>
                            <th class="p-2"><div class="">                           
                            </div>Client</th>
                            <th class="p-2">Amount</th>
                            <th class="p-2">Due Date</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">
                                Actions                           
                             </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr class="border-b">
                            <td class="p-2">{{ $invoice->invoice_number }}</td>
                            <td class="p-2">{{ $invoice->client->name }}</td>
                            <td class="p-2">${{ number_format($invoice->amount, 2) }}</td>
                            <td class="p-2">{{ $invoice->due_date }}</td>
                            <td class="p-2">
                                <span class="px-2 py-1 text-sm rounded {{ $invoice->status == 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>

                            <td class="p-2">
                                @if($invoice->status === 'pending')
                                    <form action="{{ route('invoices.mark-as-paid', $invoice) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded shadow" style="    color: black; background: beige;">
                                            Mark as Paid
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 italic">No actions</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>