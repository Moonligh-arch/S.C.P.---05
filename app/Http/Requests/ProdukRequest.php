<?php

namespace App\Http\Requests;

use App\Enums\KategoriProduk;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'merek_id'  => ['required', 'exists:merek,id'],
            'kategori'  => ['required', Rule::enum(KategoriProduk::class)],
            'nama'      => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'gambar'    => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'merek_id.required'  => 'Merek wajib dipilih.',
            'merek_id.exists'    => 'Merek yang dipilih tidak valid.',
            'kategori.required'  => 'Kategori wajib dipilih.',
            'kategori.Illuminate\Validation\Rules\Enum' => 'Kategori yang dipilih tidak valid.',
            'nama.required'      => 'Nama produk wajib diisi.',
            'nama.max'           => 'Nama produk maksimal 255 karakter.',
            'gambar.image'       => 'File harus berupa gambar.',
            'gambar.mimes'       => 'Format gambar harus JPG, JPEG, PNG, atau WebP.',
            'gambar.max'         => 'Ukuran gambar maksimal 2 MB.',
        ];
    }
}
