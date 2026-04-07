<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold">Total Chores</h3>
                    <p class="text-2xl mt-2">{{ $totalChores }}</p>
                </div>

                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold">Completed Chores</h3>
                    <p class="text-2xl mt-2">{{ $completedChores }}</p>
                </div>

                <div class="bg-white p-6 shadow rounded-lg">
                    <h3 class="text-lg font-bold">Pending Chores</h3>
                    <p class="text-2xl mt-2">{{ $pendingChores }}</p>
                </div>
            </div>

            <div class="bg-white p-6 shadow rounded-lg mb-6">
                <h3 class="text-lg font-bold mb-4">Recent Chores</h3>

                @if($chores->count())
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 border">Title</th>
                                <th class="p-2 border">Status</th>
                                <th class="p-2 border">Assigned To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chores as $chore)
                                <tr>
                                    <td class="p-2 border">{{ $chore->title }}</td>
                                    <td class="p-2 border">{{ $chore->status }}</td>
                                    <td class="p-2 border">{{ $chore->assignedUser->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No chores found.</p>
                @endif
            </div>

            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-bold mb-4">Recent Expenses</h3>

                @if($expenses->count())
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-2 border">Title</th>
                                <th class="p-2 border">Amount</th>
                                <th class="p-2 border">Added By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td class="p-2 border">{{ $expense->title }}</td>
                                    <td class="p-2 border">€{{ number_format($expense->amount, 2) }}</td>
                                    <td class="p-2 border">{{ $expense->user->name ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No expenses found.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>