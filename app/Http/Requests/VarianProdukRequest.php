<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VarianProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ram'         => 'required|string|max:50',
            'penyimpanan' => 'required|string|max:50',
            'warna'       => 'required|string|max:100',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'ram.required'         => 'RAM wajib diisi.',
            'ram.max'              => 'RAM maksimal 50 karakter.',
            'penyimpanan.required' => 'Penyimpanan wajib diisi.',
            'penyimpanan.max'      => 'Penyimpanan maksimal 50 karakter.',
            'warna.required'       => 'Warna wajib diisi.',
            'warna.max'            => 'Warna maksimal 100 karakter.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'harga.min'            => 'Harga tidak boleh kurang dari 0.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa bilangan bulat.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
        ];
    }
}
