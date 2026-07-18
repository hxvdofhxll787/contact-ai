<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'regex:/^((\+7|7|8)+([0-9]){10})$/',
            ],
            'comment' => [
                'required',
                'string',
                'min:10',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.max' => 'Name cannot be longer than 100 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email.',
            'email.max' => 'Email is too long.',

            'phone.required' => 'Phone is required.',
            'phone.regex' => 'Invalid Phone number.',

            'comment.required' => 'Comment is required.',
            'comment.min' => 'Comment must be at least 10 characters.',
            'comment.max' => 'Comment may not be greater than 100 characters.',
        ];
    }
}
