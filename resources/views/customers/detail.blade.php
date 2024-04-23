<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <span>{{ $customer->name }}</span>
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <span>{{ $customer->email }}</span>
                    </div>

                    <!-- Phone Number -->
                    <div class="mt-4">
                        <x-input-label for="phone_number" :value="__('Phone Number')" />
                        <span>{{ $customer->phone_number }}</span>
                    </div>

                    <!-- Birth Date -->
                    <div class="mt-4">
                        <x-input-label for="birth_date" :value="__('Birth Date')" />
                        {{ $customer->birth_date }}
                    </div>

                    <!-- Gender -->
                    <div class="mt-4">
                        <x-input-label for="gender" :value="__('Gender')" />
                        <span>{{ $customer->gender }}</span>
                    </div>

                    <!-- Photo -->
                    <div class="mt-4">
                        <label for="photo">Photo</label>
                        <img src="{{ asset('storage/' . $customer->photo) }}" class="h-20 w-28">
                    </div>

                    <div class="mt-4">
                        <label for="Address">Address</label>
                        <div id="addressContainer" class="mt-5">
                            @foreach ($customer->customer_addresses as $key => $value)
                                <div class="address" id="address{{ $key }}">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Recipient
                                            Name {{ $key + 1 }}</label>
                                        <span>{{ $value->recipient_name }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Name Address
                                            {{ $key + 1 }}</label>
                                        <span>{{ $value->name_address }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Detail
                                            Address {{ $key + 1 }}</label>
                                        <span>{{ $value->detail_address }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Zip Code
                                            {{ $key + 1 }}</label>
                                        <span>{{ $value->zip_code }}</span>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">Phone Number
                                            {{ $key + 1 }}</label>
                                        <span>{{ $value->phone_number }}</span>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-5 flex justify-start">
                        <a href="{{ route('customers.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
