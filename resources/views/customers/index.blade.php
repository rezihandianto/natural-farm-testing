<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('status'))
                        <div role="alert" class="alert alert-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif
                    <div class="flex items-center justify-between mb-5">
                        <x-text-input id="search" name="search" class="block mt-1" placeholder="Search" />
                        <a href="{{ route('customers.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Create</a>
                    </div>
                    <table class="table mt-5">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Birth Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="avatar">
                                                <div class="mask mask-squircle w-12 h-12">
                                                    <img src="{{ asset('storage/' . $item->photo) }}" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold">{{ $item->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->birth_date }}</td>
                                    <th>
                                        <button class="btn btn-ghost btn-xs">details</button>
                                        <button class="btn btn-ghost btn-xs">edit</button>
                                        <button class="btn btn-ghost btn-xs">delete</button>
                                    </th>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">
                                        No data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
