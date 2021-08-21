<?php

namespace App\Http\Requests\Kategori;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends BaseRequest
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
                    'nama' => 'required|unique:kategori,nama'
                ];
                break;
            case 'PUT':
                $rules = [
                    'nama' => 'required'
                ];
                break;
            default:
                $rules = [];
        }

        return $rules;
    }

}
