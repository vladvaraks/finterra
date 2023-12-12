@extends('base')
@section('content')
<h1 class="text-2xl mb-5 uppercase font-bold">Последний перевод каждого пользователя</h1>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Пользователь отправитель
                </th>
                <th scope="col" class="px-6 py-3">
                    Пользователь получатель
                </th>
                <th scope="col" class="px-6 py-3">
                    Сумма
                </th>
                <th scope="col" class="px-6 py-3">
                    Дата
                </th>
                <th scope="col" class="px-6 py-3">
                    Статус
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key)
            <tr class="bg-white border-b hover:bg-gray-50 ">
                <td class="px-6 py-4">
                    {{$key->user_out}}
                </td>
                @if($key->user_in)
                <td class="px-6 py-4">
                    {{$key->user_in}}
                </td>
                <td class="px-6 py-4">
                    {{$key->transfer_amount}}
                </td>
                <td class="px-6 py-4">
                    {{$key->transfer_start_datetime}}
                </td>
                <td class="px-6 py-4">
                    @if($key->flag_transfer)
                        Исполнено
                    @else
                        Ожидание
                    @endif
                </td>
                @else
                <td colspan="4" class="px-6 py-4">
                    У пользователя нет переводов
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-5">
{{ $data->links() }}
</div>
@endsection