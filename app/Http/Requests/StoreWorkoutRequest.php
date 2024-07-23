<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkoutRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'content' => ['required', 'string'],
            'score' => ['string'],
            'done_at' => ['date'],
            //'files' => ['array'],
           // 'files.*' => ['file', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];
    }
}
