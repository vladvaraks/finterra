@extends('auth.base_auth')
@section('content')
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="name"
                    class="block text-sm font-medium leading-6 {{ $errors->has('name') ? 'text-red-500' : 'text-gray-900' }}">Логин</label>
                <div class="mt-2">
                    <input id="name" name="name" type="text" autocomplete="off" required value="{{ old('name') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('name') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-fuchsia-600' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="email"
                    class="block text-sm font-medium leading-6 {{ $errors->has('email') ? 'text-red-500' : 'text-gray-900' }}">
                    Email</label>
                <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="off" required
                        value="{{ old('email') }}"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('email') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-fuchsia-600' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-fuchsia-600 sm:text-sm sm:leading-6">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password"
                    class="block text-sm font-medium leading-6 {{ $errors->has('password') ? 'text-red-500' : 'text-gray-900' }}">
                    Пароль</label>
                <div class="mt-2">
                    <input id="password" name="password" type="password" autocomplete="off" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-fuchsia-600' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-fuchsia-600 sm:text-sm sm:leading-6">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation"
                    class="block text-sm font-medium leading-6 {{ $errors->has('password') ? 'text-red-500' : 'text-gray-900' }}">
                    Повторите
                    пароль</label>
                <div class="mt-2">
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="off"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset {{ $errors->has('password') ? 'ring-red-500 focus:ring-red-600' : 'ring-gray-300 focus:ring-fuchsia-600' }} placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-fuchsia-600 sm:text-sm sm:leading-6">
                </div>
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-fuchsia-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-fuchsia-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-fuchsia-600">
                    Регистрация</button>
            </div>
        </form>
    </div>
@endsection
