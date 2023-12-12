@extends('auth.base_auth')
@section('content')
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            @error('no_login')
            <div class="p-4 mb-4 text-center text-base text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{ $message }}
            </div>
            @enderror
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Логин</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('name') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-fuchsia-600' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6">
                </div>
                @error('name')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Пароль</label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-fuchsia-600' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6">
                </div>
                @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-fuchsia-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-fuchsia-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-fuchsia-600">Войти</button>
            </div>
        </form>
        <p class="mt-10 text-center text-sm text-gray-500">
            Нет аккаута?
            <a href="{{ route('register') }}" class="font-semibold leading-6 text-fuchsia-600 hover:text-fuchsia-500">Регистрируйся</a>
        </p>
    </div>
@endsection
