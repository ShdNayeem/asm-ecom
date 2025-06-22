<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'category_id' => [
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'string',
                'max:50'
            ],
            'slug' => [
                'required',
                'string',
                'max:50'
            ],
            'description' => [
                'required',
                'max:250'
            ],
            'image' => [
                'nullable',
                'mimes:png,jpg,jpeg,webp'
            ],
            'price' => [
                'required',
                'string'
            ],
            'offer_price' => [
                'required',
                'string'
            ],
            'msme_no' => [
                'required',
                'string'
            ],
            'net_weight' => [
                'required',
                'string'
            ],
            'batch_no' => [
                'required',
                'string'
            ],
            'mfg_date' => [
                'required',
                'string'
            ],
            'mrp' => [
                'required',
                'string'
            ],
            'usp' => [
                'string'
            ],
        ];
    }
}
