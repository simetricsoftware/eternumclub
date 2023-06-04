<?php

namespace App\Http\Requests\Ticket;

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
            'guest' => 'required|array',
            'guest.name' => 'required|string',
            'guest.email' => 'required|email',
            'guest.phone' => 'required|string',
            'guest.identification_number' => 'required|string',
            'guest.voucher' => 'required|image',
            'answers' => 'nullable|array',
            'answers.*.question_id' => 'required|integer|exists:questions,id',
            'answers.*.response' => 'required|string',
            'tickets' => 'required|array',
            'tickets.*.ticket_type_id' => 'required|integer',
            'tickets.*.quantity' => 'required|integer',
        ];
    }
}
