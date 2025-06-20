<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:10',
            'stock' => 'nullable|numeric|min:0',
            'categories' => 'required|array',
            'categories.*.id' => 'required|integer',
            'categories.*.name' => 'required|string',
            'expiration_date' => [
                'nullable',
                'sometimes',
                'date_format:Y-m-d\TH:i:s.v\Z',
                'required_if:hasFoodCategory,true'
            ],
        ];
    }

    /**
    * Get custom messages for validator errors.
    *
    * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El nombre no debe exceder los 100 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe exceder los 255 caracteres.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un valor numérico.',
            'price.min' => 'El precio debe ser al menos 10.',
            'stock.numeric' => 'El stock debe ser un valor numérico.',
            'stock.min' => 'El stock no puede ser negativo.',
            'categories.required' => 'Debe seleccionar al menos una categoría.',
            'categories.array' => 'Las categorías deben ser un arreglo.',
            'categories.*.id.required' => 'El ID de la categoría es obligatorio.',
            'categories.*.id.integer' => 'El ID de la categoría debe ser un número entero.',
            'categories.*.name.required' => 'El nombre de la categoría es obligatorio.',
            'categories.*.name.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'expiration_date.date_format' => 'La fecha de vencimiento no tiene el formato esperado',
            'expiration_date.required_if' => 'La fecha de vencimiento es obligatoria sí el producto es de tipo alimento.',
        ];
    }
}
