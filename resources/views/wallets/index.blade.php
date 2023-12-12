@extends('base')
@section('content')
    @error('count_wallets_error')
        <div class="p-4 mb-4 text-center text-2xl text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            {{ $message }}
        </div>
    @enderror
    @if(session('message_success'))
        <div class="p-4 mb-4 text-center text-2xl text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            {{ session('message_success') }}
        </div>
    @enderror
    <div class="flex flex-col xl:flex-row">
        @foreach ($wallets as $wallet)
            <div
                class="w-full max-w-sm mb-5 xl:mr-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="px-5 py-5">
                    <div class="flex justify-between text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        <span>Счет номер:</span>
                        <span>{{ $wallet->id }}</span>
                    </div>
                    <div class="flex items-center justify-between pt-5">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Баланс: {{ $wallet->balance }} Р.</span>
                    </div>
                    <div class="flex items-center justify-between pt-5">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">Зарезервировано: {{ $wallet->sum_amount }}
                            Р.</span>
                    </div>
                    <div class="flex items-center justify-between pt-5">
                        <a href="{{ route('edit_wallet', $wallet->id) }}"
                            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Пополнить
                            счет</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-5">
        <form action="{{ route('create_wallet') }}" method="POST">
            @csrf
            <button type="submit"
                class="text-white bg-fuchsia-700 hover:bg-fuchsia-800 focus:ring-4 focus:outline-none focus:ring-fuchsia-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-fuchsia-600 dark:hover:bg-fuchsia-700 dark:focus:ring-fuchsia-800">
                Открыть новый счет
            </button>
        </form>
    </div>
@endsection