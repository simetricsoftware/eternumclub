<?php

namespace App\Rules;

use App\Models\Event;
use App\Models\Hash;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmailByEvent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(
        private Event $event,
    ) {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !Hash::where('email', $value)->where('event_id', $this->event->id)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ya se han registrado a este evento con este correo.';
    }
}
