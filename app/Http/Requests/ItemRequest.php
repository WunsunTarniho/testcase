<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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
    public function rules()
    {
        $itemId = $this->input('id'); 

        $rules = [
            'item_name' => 'required|string',
            'code' => [Rule::unique('items')->ignore($itemId)],
            'item_group_id' => 'required|uuid',
            'account_group_id' => 'required|uuid',
            'unit_id' => 'required|uuid',
            'is_active' => '',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'item_name' => 'The title field is required',
            'item_group_id' => 'Choose item group',
            'account_group_id' => 'Choose account group',
            'unit_id' => 'Choose unit for item',
            'code' => 'This code has been taken',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'message' => 'Infalid field',
            'errors' => $errors
        ], 422));
    }
}
