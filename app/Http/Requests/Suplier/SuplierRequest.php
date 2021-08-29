<?php

namespace App\Http\Requests\Suplier;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class SuplierRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                $rules = [
                    'nama' => 'required|unique:suplier,nama',
                    'provinsi' => 'required',
                    'kota' => 'required',
                    'kecamatan' => 'required',
                    'kelurahan' => 'required',
                    'alamat' => 'required',
                    'telepon' => 'required'
                ];
                break;
            case 'PUT':
                $rules = [
                    'nama' => 'required',
                    'provinsi' => 'nullable',
                    'kota' => 'nullable',
                    'kecamatan' => 'nullable',
                    'kelurahan' => 'nullable',
                    'alamat' => 'nullable',
                    'telepon' => 'nullable'
                ];
                break;
            default:
                $rules = [];
        }

        return $rules;
    }
}
