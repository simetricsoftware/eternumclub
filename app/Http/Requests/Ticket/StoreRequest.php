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
            'assistant' => 'required|array',
            'assistant.name' => 'required|string',
            'assistant.email' => 'required|email',
            'assistant.phone' => 'required|string',
            'assistant.identification_number' => 'required|string',
            'assistant.voucher' => 'required|image',
            'answers' => 'nullable|array',
            'answers.*.question_id' => 'required|integer|exists:questions,id',
            'answers.*.response' => 'required|string',
            'tickets' => 'required|array',
            'tickets.*.ticket_type_id' => 'required|integer',
            'tickets.*.quantity' => 'required|integer',
        ];
    }
}
