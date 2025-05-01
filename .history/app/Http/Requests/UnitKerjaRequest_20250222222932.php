<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitKerjaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $unitKerjaId = $this->route('unitKerja'); // Ambil ID jika update

        return [
            'kode_unit_kerja' => 'required|string|max:10|unique:unit_kerjas,kode_unit_kerja,' . $unitKerjaId,
            'nama_unit_kerja' => 'required|string|max:100',
            'jenis_unit_kerja' => 'required|in:fakultas,prodi,lembaga,upt',
            'jenjang' => 'nullable|in:D2,D3,D4,S1,S2,S3',
            'fakultas' => 'nullable|string|max:100'
        ];

        public function messages()
    {
        return [
            'kode_unit_kerja.required' => 'Kode unit kerja wajib diisi.',
            'kode_unit_kerja.string' => 'Kode unit kerja harus berupa teks.',
            'kode_unit_kerja.max' => 'Kode unit kerja tidak boleh lebih dari 10 karakter.',
            'kode_unit_kerja.unique' => 'Kode unit kerja sudah digunakan, pilih kode lain.',

            'nama_unit_kerja.required' => 'Nama unit kerja wajib diisi.',
            'nama_unit_kerja.string' => 'Nama unit kerja harus berupa teks.',
            'nama_unit_kerja.max' => 'Nama unit kerja tidak boleh lebih dari 100 karakter.',

            'jenis_unit_kerja.required' => 'Jenis unit kerja wajib dipilih.',
            'jenis_unit_kerja.in' => 'Jenis unit kerja tidak valid.',

            'jenjang.in' => 'Jenjang tidak valid, pilih dari D2, D3, D4, S1, S2, atau S3.',

            'fakultas.string' => 'Fakultas harus berupa teks.',
            'fakultas.max' => 'Fakultas tidak boleh lebih dari 100 karakter.'
        ];
    }
    }
}
