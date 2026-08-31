<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:225',
            'jenis_id' => 'required|string',
            'purchase_price' => 'required|integer|min:0',
            'selling_price' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ];
    }
    
    public function messages(): array
    {
        return [
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Extensi gambar harus JPG, JPEG, atau PNG.',
            'foto.max' => 'Maksimal ukuran gambar 2MB.',
            'name.required' => 'Nama wajib diisi.',
            'jenis_id.required' => 'Jenis produk wajib dipilih.',
            'purchase_price.required' => 'Purchase price wajib diisi.',
            'purchase_price.integer' => 'Purchase price harus diisi bilangan bulat.',
            'selling_price.required' => 'Selling price wajib diisi.',
            'selling_price.integer' => 'Selling price harus diisi bilangan bulat.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus diisi angka.',
        ];
    }
}