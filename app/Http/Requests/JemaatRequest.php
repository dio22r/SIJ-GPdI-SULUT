<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JemaatRequest extends FormRequest
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
            "address" => "nullable",
            "sex" => "required|in:L,P",
            "date_birth" => "required",
            "place_birth" => "required",
            "telp" => "nullable",
            "email" => "nullable|email",
            "blood_group" => "nullable",
            "marital_status" => "required|in:S,M,J,D",
            "job" => "nullable",
            "activity" => "nullable"
        ];
    }
}
