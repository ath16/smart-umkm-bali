<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'cost_price' => ['required', 'numeric', 'min:0', 'max:999999999999.99'],
            'sell_price' => ['required', 'numeric', 'min:0', 'max:999999999999.99', 'gte:cost_price'],
            'stock' => ['required', 'integer', 'min:0', 'max:999999'],
            'weight' => ['required', 'integer', 'min:1'],
            'min_stock' => ['required', 'integer', 'min:0', 'max:999999'],
            'is_published' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
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
            'name' => 'nama produk',
            'cost_price' => 'harga modal',
            'sell_price' => 'harga jual',
            'stock' => 'stok',
            'min_stock' => 'stok minimum',
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
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk maksimal 255 karakter.',
            'cost_price.required' => 'Harga modal wajib diisi.',
            'cost_price.numeric' => 'Harga modal harus berupa angka.',
            'cost_price.min' => 'Harga modal tidak boleh negatif.',
            'sell_price.required' => 'Harga jual wajib diisi.',
            'sell_price.numeric' => 'Harga jual harus berupa angka.',
            'sell_price.min' => 'Harga jual tidak boleh negatif.',
            'sell_price.gte' => 'Harga jual harus sama atau lebih besar dari harga modal.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh negatif.',
            'min_stock.required' => 'Stok minimum wajib diisi.',
            'min_stock.integer' => 'Stok minimum harus berupa bilangan bulat.',
            'min_stock.min' => 'Stok minimum tidak boleh negatif.',
        ];
    }
}
