<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdukRequest extends FormRequest
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
                    'nama' => 'required',
                    'kategori_id' => 'required|exists:kategori,id',
                    'stok' => 'required|min:1|numeric',
                    'satuan_id' => 'required|exists:satuan,id',
                    'harga_beli' => 'required|numeric',
                    'harga_jual' => 'required|numeric|gte:harga_beli'
                ];
                break;

            case 'PUT':
                $rules = [
                    'nama' => 'required',
                    'kategori_id' => 'required|exists:kategori,id',
                    'stok' => 'required|min:1|numeric',
                    'satuan_id' => 'required|exists:satuan,id',
                    'harga_beli' => 'required|numeric',
                    'harga_jual' => 'required|numeric'
                ];
                break;

            default:
                $rules = [];
                break;
        }

        return $rules;
    }
}
