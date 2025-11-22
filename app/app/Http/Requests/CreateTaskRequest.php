<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateTaskRequest extends FormRequest
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
            'title' => 'required|string|max:255|min:3',
            'description' => 'sometimes|string|max:255|min:2',
            'due_date' => 'required|date_format:Y-m-d',
            'project_id' => 'required|string|exists:projects,id',
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
            'title.required' => 'O título da tarefa é obrigatório.',
            'title.string' => 'O título da tarefa deve ser um texto.',
            'title.max' => 'O título da tarefa não pode ter mais de 255 caracteres.',
            'title.min' => 'O título da tarefa deve ter pelo menos 3 caracteres.',
            'description.string' => 'A descrição da tarefa deve ser um texto.',
            'description.max' => 'A descrição da tarefa não pode ter mais de 255 caracteres.',
            'description.min' => 'A descrição da tarefa deve ter pelo menos 2 caracteres.',
            'due_date.required' => 'A data de vencimento é obrigatória.',
            'due_date.date_format' => 'A data de vencimento deve estar no formato YYYY-MM-DD.',
            'project_id.required' => 'O ID do projeto é obrigatório.',
            'project_id.exists' => 'O ID do projeto informado não existe.',
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
            'title' => 'título da tarefa',
            'description' => 'descrição da tarefa',
            'due_date' => 'data de vencimento',
            'project_id' => 'ID do projeto',
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
