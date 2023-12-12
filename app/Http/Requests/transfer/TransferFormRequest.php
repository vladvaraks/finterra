<?php

namespace App\Http\Requests\transfer;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ActiveWallet;
use App\Rules\AvailableBalance;
use App\Rules\DifferentUsers;
use App\Rules\WalletBelongAuthUser;

class TransferFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'select_wallets' => ['required', 'numeric', new WalletBelongAuthUser],
            'ajax_select_get_users' => ['required', 'numeric', new DifferentUsers, new ActiveWallet],
            'datetime_transfer' => ['required', 'date_format:d.m.Y H:i', 'after_or_equal:today'],
            'balance' => ['required', 'numeric', 'min:10', new AvailableBalance]
        ];
    }

    public function messages()
    {
        return [
            'select_wallets.required' => 'Поле Кошелёк обязательно для заполнения.',
            'select_wallets.numeric' => 'Поле Логин должно быть номером.',
            'ajax_select_get_users.required' => 'Поле Пользователь обязательно для заполнения.',
            'ajax_select_get_users.numeric' => 'Поле Пользователь должно быть номером.',
            'balance.required' => 'Поле Сумма перевода обязательно для заполнения.',
            'balance.numeric' => 'Поле Сумма перевода должно быть числом.',
            'balance.min' => 'Поле Сумма перевода должно иметь минимальную длину :min символов.',
            'datetime_transfer.required' => 'Поле Дата и время перевода обязательно для заполнения.',
            'datetime_transfer.after_or_equal' => 'Поле Дата и время должно содержать дату, следующую за текущей или равную ей.',
            'datetime_transfer.date_format' => 'Поле Дата и время перевода должно быть в формате 01.01.2023 11:00',
        ];
    }
}
