<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreNasabahFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => ['required', 'digits:16', 'unique:nasabah'],
            'nama_lengkap' => ['required', 'max:255'],
            'nomor_telepon' => ['required', 'regex:/^\+?(\d[\d -]{7,}\d)$/', 'unique:nasabah'],
            'nomor_telepon_jaminan' => ['required', 'regex:/^\+?(\d[\d -]{7,}\d)$/', 'unique:nasabah'],
            'tempat_lahir' => ['required', 'max:255'],
            'tgl_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
            'pekerjaan' => ['required', 'max:30'],
            'nama_ibu' => ['required', 'max:255'],
            'no_rekening' => ['required', 'max:15'],
            'jenis_bank' => ['required', 'max:15'],
            'alamat' => ['required', 'max:255'],
            'foto_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
