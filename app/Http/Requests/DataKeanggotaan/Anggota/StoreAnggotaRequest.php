<?php

namespace App\Http\Requests\DataKeanggotaan\Anggota;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnggotaRequest extends FormRequest
{
    protected $errorBag = 'store';

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
            'nik'           => 'required|numeric|digits:16|unique:anggota,nik',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'grup_id'       => 'required|exists:grup,id',
            'alamat'        => 'required|string|max:500',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
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
            'nik'           => 'NIK',
            'nama'          => 'Nama Anggota',
            'jenis_kelamin' => 'Jenis Kelamin',
            'grup_id'       => 'Nama Grup',
            'alamat'        => 'Alamat',
            'foto'          => 'Foto'
        ];
    }
}
