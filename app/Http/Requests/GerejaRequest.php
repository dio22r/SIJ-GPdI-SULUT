<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GerejaRequest extends FormRequest
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
        return [
            "name" => "required",
            "address" => "required",
            "date_birth" => "nullable|date",
            "mh_wilayah_id" => "nullable"
        ];
    }
}
