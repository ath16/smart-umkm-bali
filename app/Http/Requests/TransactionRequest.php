<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'payment_amount' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang tidak boleh kosong.',
            'items.min' => 'Minimal tambahkan 1 produk ke keranjang.',
            'items.*.product_id.required' => 'Produk wajib dipilih.',
            'items.*.product_id.exists' => 'Produk tidak ditemukan.',
            'items.*.quantity.required' => 'Jumlah wajib diisi.',
            'items.*.quantity.min' => 'Jumlah minimal 1.',
            'payment_amount.required' => 'Jumlah pembayaran wajib diisi.',
            'payment_amount.min' => 'Jumlah pembayaran tidak boleh negatif.',
            'notes.max' => 'Catatan maksimal 500 karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'items' => 'keranjang',
            'payment_amount' => 'jumlah pembayaran',
            'notes' => 'catatan',
        ];
    }
}
