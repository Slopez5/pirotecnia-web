<?php

namespace App\Presentation\Http\Requests;

class CreateEventRequest extends BaseApiRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'appVersion' => $this->header('X-APP-VERSION'),
            'osVersion' => $this->header('X-OS-VERSION'),
            'appVersion' => $this->header('X-APP-VERSION'),

        ]);
    }

    public function rules(): array
    {
        return [
            'appVersion' => ['required'],

            'eventTypeId' => ['required', 'exists:event_types,id'],
            'packageId' => ['required', 'exists:packages,id'],
            'date' => ['required', 'date'],
            'phone' => ['required'],
            'clientName' => ['required'],
            'clientAddress' => ['required'],
            'eventAddress' => ['required'],
            'eventDate' => ['required', 'date'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount' => ['sometimes', 'numeric', 'min:0'],
            'travelExpenses' => ['sometimes', 'numeric', 'min:0'],
            'advance' => ['sometimes', 'numeric', 'min:0'],
            'notes' => ['sometimes', 'required'],
            'employees' => ['sometimes', 'array'],
            'employees.*.id' => ['required', 'exists:employees,id'],
            'employees.*.salary' => ['sometimes', 'required', 'numeric', 'min:1'],
            'packages' => ['sometimes', 'array'],
            'packages.*.id' => ['required'],
            'packages.*.price' => ['sometimes', 'numeric', 'min:0'],
            'products' => ['sometimes', 'array'],
            'products.*.id' => ['required'],
            'products.*.quantity' => ['sometimes', 'numeric', 'min:0'],
            'products.*.price' => ['sometimes', 'numeric', 'min:0'],
            'equipments' => ['sometimes', 'array'],
            'equipments.*.id' => ['required'],
            'equipments.*.quantity' => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}
