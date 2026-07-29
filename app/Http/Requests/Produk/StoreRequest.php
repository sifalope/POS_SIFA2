<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string|max:225',
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
            'purchase_price.required' => 'Purchase price wajib diisi.',
            'purchase_price.integer' => 'Purchase price harus diisi bilangan bulat.',
            'selling_price.required' => 'Selling price wajib diisi.',
            'selling_price.integer' => 'Selling price harus diisi bilangan bulat.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus diisi angka.',
        ];
    }
}