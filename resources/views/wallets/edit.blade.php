@extends('base')
@section('content')
    @error('count_wallets_error')
        <div class="p-4 mb-4 text-center text-2xl text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            {{ $message }}
        </div>
    @enderror
    <form action="{{ route('update_wallet', $wallet->id) }}" method="post">
        @csrf
        @method('patch')
        <div class="mb-5 max-w-sm">
            <label for="balance" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Сумма пополнения:</label>
            <div class="flex">
                <input type="text" id="balance" name="balance" value="{{ old('balance') }}"
                class="rounded-none rounded-s-lg bg-gray-50 border {{ $errors->has('balance') ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-grey-500 focus:ring-fuchsia-500 focus:border-fuchsia-500' }} text-center text-gray-900 block flex-1 min-w-0 w-full text-base p-2.5 " 
                placeholder="Введите сумму пополнения">
                <span class="inline-flex items-center px-3 text-base text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                Р
                </span>
            </div>
            @error('balance')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit"
            class="text-white w-full max-w-sm bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Пополнить
        </button>
    </form>
@endsection

@section('block_js')
<script>

    document.getElementById("balance").addEventListener('input', function(event) {
        let v = this.value;
        v = v.replace(/,/g, '.');
        v = v.replace(/[^\.0-9]/g, '');
        if(v.match(/\.\d{3,}/)) {
            v = v.substr(0, v.indexOf('.') + 3);
        }
        if (v.match(/\./g)) {
            if(v.match(/\./g).length > 1) {
            v = v.substr(0, v.lastIndexOf("."));
        }};
        this.value = v;
    });
</script>
@endsection

