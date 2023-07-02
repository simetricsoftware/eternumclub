<?php

namespace App\Http\Requests\BankAccount;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bankAccounts' => 'nullable|array',
            'bankAccounts.*.identification_number' => 'required|string',
            'bankAccounts.*.name' => 'required|string',
            'bankAccounts.*.bank' => 'required|string',
            'bankAccounts.*.account_number' => 'required|string',
            'bankAccounts.*.account_type' => 'required|in:savings,current',
            'bankAccounts.*.email' => 'required|email',
        ];
    }
}
