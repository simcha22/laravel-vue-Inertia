<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResultRequest extends FormRequest
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
            'sets' => 'required|numeric|between:5,20',
            'reps' =>  'required|numeric|between:1,20',
            'type' => ['required', Rule::in(['constant','variable'])],
            'level' => ['required', Rule::in(['rx', 'scaled'])],
            'weight' => 'required|array',
            'weight.*' => 'required|array',
            'done_at' => 'required|date',
            'weight.*.reps' =>  'required|numeric|between:1,20',
            'weight.*.value' =>  'required|numeric|between:5,350',
            'weight.*.percent' =>  'required|numeric|between:5,105',
        ];
    }
}
