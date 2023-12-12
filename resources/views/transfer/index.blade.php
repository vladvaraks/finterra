@extends('base')
@section('content')
    @if(session('message_success'))
    <div class="p-4 mb-4 text-center text-2xl text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
        role="alert">
        {{ session('message_success') }}
    </div>
    @enderror
    <form action="{{ route('transfer') }}" method="post">
        @csrf
        <div class="mb-5 max-w-sm">
            <label for="select_wallets" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Кошелёк:</label>
            <select id="select_wallets" name="select_wallets"
                    class="text-center border border-gray-300 text-gray-900 text-base rounded-lg {{ $errors->has('select_wallets') ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-grey-300 focus:ring-fuchsia-500 focus:border-fuchsia-500' }} block w-full p-2.5">
                <option value="" disabled selected hidden>Выберите кошелёк</option>
                @foreach ($wallets as $key)
                    <option value="{{ $key['id'] }}"
                    @if ($key['id'] == old('select_wallets'))
                        selected="selected"
                    @endif
                    >Кошелёк № {{$key['id']}} Баланс {{$key['balance']}}</option>
                @endforeach
            </select>
            @error('select_wallets')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-5 max-w-sm">
            <label for="ajax_select_get_users" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Пользователь:</label>
            <select id="ajax_select_get_users" name="ajax_select_get_users" class="w-full">
            </select>
            @error('ajax_select_get_users')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-5 max-w-sm">
            <label for="balance" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Дата и время перевода:</label>
            <input type="text" id="datetime_transfer" name="datetime_transfer" value="{{ old('datetime_transfer') }}" readonly="" placeholder="Выберите дату и время"
                class="border border-gray-300 text-gray-900 text-base text-center rounded-lg {{ $errors->has('datetime_transfer') ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-grey-300 focus:ring-fuchsia-500 focus:border-fuchsia-500' }} block w-full p-2.5 ">
            @error('datetime_transfer')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-5 max-w-sm">
            <label for="balance" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Сумма
                перевода:</label>
            <div class="flex">
                <input type="text" id="balance" name="balance" value="{{ old('balance') }}"
                    class="rounded-none rounded-s-lg border {{ $errors->has('balance') ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-fuchsia-500 focus:border-fuchsia-500' }} text-center text-gray-900 block flex-1 min-w-0 w-full text-base p-2.5 "
                    placeholder="Введите сумму перевода">
                <span
                    class="inline-flex items-center px-3 text-base text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                    Р
                </span>
            </div>
            @error('balance')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit"
            class="text-white w-full max-w-sm bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            Перевести
        </button>
    </form>
@endsection

@section('block_js')
    <script>
        new AirDatepicker('#datetime_transfer', {
            timepicker: true,
            minMinutes: 0,
            maxMinutes: 0,
        });

        $("#ajax_select_get_users").select2({
            ajax: {
                url: "{{ route('ajax_users') }}",
                type: 'get',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchItem: params.term,
                        page: params.page
                    }
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.data,
                        pagination: {
                            more: data.last_page != params.page
                        }
                    }
                },
                catch: true,
            },
            placeholder: 'Выберите пользователя',
            templateResult: templateResult,
            templateSelection: templateSelection,
            "language": {
                "noResults": function() {
                    return "Нет результатов поиска";
                },
                "searching": function() {
                    return 'Поиск…';
                },
            }
        });
        if ("{{ old('ajax_select_get_users') }}") {
            var userSelect = $('#ajax_select_get_users');

            $.ajax({
                type: 'GET',
                url: "api/v1/ajax/users/{{ old('ajax_select_get_users') }}"
                }).then(function(data) {
                    var option = new Option(data.user.name, data.user.id, true, true);
                    userSelect.append(option).trigger('change');

                    userSelect.trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    });
            });
        }
    
        function templateResult(data) {
            if (data.loading) {
                return data.text
            }
            return data.name
        }

        function templateSelection(data) {
            return data.text || data.name
        }

        document.getElementById("balance").addEventListener('input', function(event) {
            let v = this.value;
            v = v.replace(/,/g, '.');
            v = v.replace(/[^\.0-9]/g, '');
            if (v.match(/\.\d{3,}/)) {
                v = v.substr(0, v.indexOf('.') + 3);
            }
            if (v.match(/\./g)) {
                if (v.match(/\./g).length > 1) {
                    v = v.substr(0, v.lastIndexOf("."));
                }
            };
            this.value = v;
        });
    </script>
@endsection
