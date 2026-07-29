<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',         
                Rule::unique('users')->ignore($this->user->id),
            ],
            'password' => 'nullable|min:8',
            'role_id'  => 'required',
            'is_active' => 'boolean',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'purchase_price' => 'required|integer',
            'selling_price'  => 'required|integer',
            'stok'           => 'required|integer',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'foto.image'     => 'File yang diupload harus gambar.',
            'foto.mimes'     => 'Ekstensi gambar harus JPG, JPEG, PNG.',
            'foto.max'       => 'Maksimal ukuran gambar 2MB.',
            'name.required'  => 'Nama wajib di isi.',
            'name.max'       => 'Maksimal panjang nama 100 karakter.',
            'email.required' => 'Email wajib di isi.',
            'email.email'    => 'Format email tidak valid.',
            'password.min'   => 'Password minimal :min karakter.',
            'role_id.required' => 'Role wajib di isi.',
            'purchase_price.required' => 'Purchase price wajib di isi.',
            'purchase_price.integer'  => 'Purchase price harus di isi bilangan bulat.',
            'selling_price.required'  => 'Selling price wajib di isi.',
            'selling_price.integer'   => 'Selling price harus di isi bilangan bulat.',
            'stok.required'  => 'Stok wajib di isi.',
            'stok.integer'   => 'Stok harus di isi angka.',
        ];
    }
}
