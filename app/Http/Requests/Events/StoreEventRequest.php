<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role_id === 2;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_type_id' => 'required',
            'package_id' => 'required',
            'date' => 'required|date',
            'phone' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string|max:255',
            'event_address' => 'required|string|max:255',
            'event_date' => 'required|date',
            'discount' => 'nullable|numeric',
            'advance' => 'nullable|numeric',
            'travel_expenses' => 'nullable|numeric',
            'notes' => 'nullable|string|max:255',
            'reminder_send_date' => 'nullable|date',
            'reminder_send' => 'nullable|boolean',
        ];
    }

    protected function failedAuthorization()
    {
        logger('Unauthorized access attempt to StoreEventRequest');
        throw new HttpResponseException(
            response()->failure('Unauthorized', 403)
        );
    }
}
