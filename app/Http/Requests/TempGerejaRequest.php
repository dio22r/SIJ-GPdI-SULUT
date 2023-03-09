<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempGerejaRequest extends FormRequest
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
            "pastor_name" => "required",
            "spouse_name" => "required",
            "telp" => "required",
            "pelnap_l" => "required|numeric",
            "pelnap_p" => "required|numeric",
            "pelrap_l" => "required|numeric",
            "pelrap_p" => "required|numeric",
            "pelpap_l" => "required|numeric",
            "pelpap_p" => "required|numeric",
            "pelprip" => "required|numeric",
            "pelwap" => "required|numeric",
            "kk" => "required|numeric",
        ];
    }
}
