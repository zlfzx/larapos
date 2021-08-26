<?php

namespace App\Http\Requests\Satuan;

use Illuminate\Foundation\Http\FormRequest;

class SatuanRequest extends FormRequest
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
                    'nama' => 'required|unique:satuan,nama',
                    'kode' => 'required|unique:satuan,kode'
                ];
                break;
            case 'PUT':
                $rules = [
                    'nama' => 'required',
                    'kode' => 'required'
                ];
                break;
            default:
                $rules = [];
        }

        return $rules;
    }
}
