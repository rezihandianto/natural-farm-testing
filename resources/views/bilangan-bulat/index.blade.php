<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bilangan Bulat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Penjumlahan Array Kecuali Indeks Sendiri') }}
                </div>
                <div class="p-6 text-gray-900">
                    <x-input-label for="inputArray">Masukkan array (pisahkan dengan koma):</x-input-label>
                    <x-text-input type="text" id="inputArray" placeholder="10, 20, 30, 40, 50" class="mx-2" />
                    <x-primary-button id="hitungBtn">Hitung</x-primary-button>
                </div>
                <div class="p-6 text-gray-900">
                    <div class="result" id="result"></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script type="text/javascript">
    $(function() {
        $('#hitungBtn').click(function() {
            const inputArray = $('#inputArray').val().split(',').map(Number);
            let result = [];

            inputArray.forEach((num, index) => {
                let sum = inputArray.reduce((acc, val, idx) => (idx !== index ? acc + val :
                    acc), 0);
                result.push(sum);
            });

            $('#result').text('Hasil: ' + result.join(', '));
        });
    })
</script>
