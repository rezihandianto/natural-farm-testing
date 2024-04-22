<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone Number -->
                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('Phone Number')" />
                            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                :value="old('phone_number')" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Birth Date -->
                        <div class="mt-4">
                            <x-input-label for="birth_date" :value="__('Birth Date')" />
                            <x-text-input id="birth_date" class="mt-1" type="date" name="birth_date"
                                :value="old('birth_date')" />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>

                        <!-- Gender -->
                        <div class="mt-4">
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender"
                                class="block mt-1 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
                                :value="old('gender')">
                                <option>--Select Gender--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- Photo -->
                        <div class="mt-4">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo"
                                class="block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <div id="addressContainer">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4 address">
                                            <label class="block text-sm font-medium text-gray-700">Recipient
                                                Name 1</label>
                                            <input type="text" name="customer_address[0][recipient_name]"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </div>
                                        <div class="mb-4 address">
                                            <label class="block text-sm font-medium text-gray-700">Name Address
                                                1</label>
                                            <input type="text" name="customer_address[0][name_address]"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </div>
                                        <div class="mb-4 address">
                                            <label class="block text-sm font-medium text-gray-700">Detail
                                                Address 1</label>
                                            <textarea rows="5" name="customer_address[0][detail_address]"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                        </div>
                                        <div class="mb-4 address">
                                            <label class="block text-sm font-medium text-gray-700">Zip Code
                                                1</label>
                                            <input type="text" name="customer_address[0][zip_code]"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                maxlength="5">
                                        </div>
                                        <div class="mb-4 address">
                                            <label class="block text-sm font-medium text-gray-700">Phone Number
                                                1</label>
                                            <input type="text" name="customer_address[0][phone_number_address]"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="addAddress"
                                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Address
                            </button>
                        </div>
                        <div class="mt-5 flex justify-end">
                            <x-primary-button>Save</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $(function() {
        let addressIndex = 0;

        $('#addAddress').on('click', function() {
            addressIndex++;
            const newAddress = `
                                <div class="mb-4 address">
                                    <label class="block text-sm font-medium text-gray-700">Recipient
                                        Name ${addressIndex +1}</label>
                                    <input type="text" name="customer_address[${addressIndex}][recipient_name]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="mb-4 address">
                                    <label class="block text-sm font-medium text-gray-700">Name Address
                                        ${addressIndex +1}</label>
                                    <input type="text" name="customer_address[${addressIndex}][name_address]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="mb-4 address">
                                    <label class="block text-sm font-medium text-gray-700">Detail
                                        Address ${addressIndex + 1}</label>
                                    <textarea rows="5" name="customer_address[${addressIndex}][detail_address]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                                </div>
                                <div class="mb-4 address">
                                    <label class="block text-sm font-medium text-gray-700">Zip Code
                                        ${addressIndex + 1}</label>
                                    <input type="text" name="customer_address[${addressIndex}][zip_code]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="5">
                                </div>
                                <div class="mb-4 address">
                                    <label class="block text-sm font-medium text-gray-700">Phone Number
                                        ${addressIndex + 1}</label>
                                    <input type="text" name="customer_address[${addressIndex}][phone_number_address]"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                `;
            $('#addressContainer').append(newAddress);
        });
    });
</script>
