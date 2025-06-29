<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'weight' => ['required', 'numeric', 'min:1', 'max:500'],
            'height' => ['required', 'numeric', 'min:50', 'max:300'],
            'age' => ['required', 'integer', 'min:1', 'max:150'],
            'activity_level' => ['required', 'string', 'in:sedentary,lightly_active,moderately_active,very_active,extremely_active'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'fullname.required' => 'Nama lengkap wajib diisi.',
            'fullname.string' => 'Nama lengkap harus berupa teks.',
            'fullname.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'weight.required' => 'Berat badan wajib diisi.',
            'weight.numeric' => 'Berat badan harus berupa angka.',
            'weight.min' => 'Berat badan minimal 1 kg.',
            'weight.max' => 'Berat badan maksimal 500 kg.',
            'height.required' => 'Tinggi badan wajib diisi.',
            'height.numeric' => 'Tinggi badan harus berupa angka.',
            'height.min' => 'Tinggi badan minimal 50 cm.',
            'height.max' => 'Tinggi badan maksimal 300 cm.',
            'age.required' => 'Usia wajib diisi.',
            'age.integer' => 'Usia harus berupa angka bulat.',
            'age.min' => 'Usia minimal 1 tahun.',
            'age.max' => 'Usia maksimal 150 tahun.',
            'activity_level.required' => 'Tingkat aktivitas wajib dipilih.',
            'activity_level.in' => 'Tingkat aktivitas tidak valid.',
        ];
    }
}
