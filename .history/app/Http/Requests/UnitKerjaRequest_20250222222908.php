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
        return [
            // Cek apakah sedang update atau create
            $unitKerjaId = $this->route('unitKerja'); // Ambil ID jika update

            return [
                'kode_unit_kerja' => 'required|string|max:10|unique:unit_kerjas,kode_unit_kerja,' . $unitKerjaId,
                'nama_unit_kerja' => 'required|string|max:100',
                'jenis_unit_kerja' => 'required|in:fakultas,prodi,lembaga,upt',
                'jenjang' => 'nullable|in:D2,D3,D4,S1,S2,S3',
                'fakultas' => 'nullable|string|max:100'
            ];
        ];
    }
}
