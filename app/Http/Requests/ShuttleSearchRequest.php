<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShuttleSearchRequest extends FormRequest
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
            'from_location_id' => 'required|exists:locations,location_id',
            'to_location_id' => 'required|different:from_location_id|exists:locations,location_id',
            'time_slot_id' => 'required|exists:time_slots,time_slot_id',
        ];
    }
}
