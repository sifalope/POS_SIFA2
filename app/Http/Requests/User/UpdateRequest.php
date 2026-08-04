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
     */
    public function rules(): array
    {
        // Mengambil ID user dari route agar email user ini diabaikan saat validasi unique
        $userId = $this->route('user')->id ?? $this->user->id;

        return [
            'name'     => 'required|string|max:100',
            'email'    => [
                'required',
                'email',         
                Rule::unique('users')->ignore($userId),
            ],
            'password'  => 'nullable|min:8',
            'role_id'   => 'required',
            'is_active' => 'nullable|boolean',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'foto.image'       => 'File yang diupload harus gambar.',
            'foto.mimes'       => 'Ekstensi gambar harus JPG, JPEG, PNG.',
            'foto.max'         => 'Maksimal ukuran gambar 2MB.',
            'name.required'    => 'Nama wajib diisi.',
            'name.max'         => 'Maksimal panjang nama 100 karakter.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'email.unique'     => 'Email ini sudah digunakan oleh akun lain.',
            'password.min'     => 'Password minimal :min karakter.',
            'role_id.required' => 'Role wajib diisi.',
        ];
    }
}