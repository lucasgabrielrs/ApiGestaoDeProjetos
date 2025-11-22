<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateTaskRequest extends FormRequest
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
            'status' => 'sometimes|string|max:25|min:3',
            'description' => 'sometimes|string|max:255|min:2',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.string' => 'O status da tarefa deve ser um texto.',
            'status.max' => 'O status da tarefa não pode ter mais de 25 caracteres.',
            'status.min' => 'O status da tarefa deve ter pelo menos 3 caracteres.',
            'description.string' => 'A descrição da tarefa deve ser um texto.',
            'description.max' => 'A descrição da tarefa não pode ter mais de 255 caracteres.',
            'description.min' => 'A descrição da tarefa deve ter pelo menos 2 caracteres.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'status' => 'status da tarefa',
            'description' => 'descrição da tarefa',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Dados inválidos enviados.',
                'errors' => $errors
            ], 422)
        );
    }
}