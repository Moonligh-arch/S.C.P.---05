<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerekRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $merekId = $this->route('merek')?->id;

        return [
            'nama' => "required|string|max:255|unique:merek,nama,{$merekId}",
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama merek wajib diisi.',
            'nama.max' => 'Nama merek maksimal 255 karakter.',
            'nama.unique' => 'Nama merek sudah digunakan.',
        ];
    }
}
