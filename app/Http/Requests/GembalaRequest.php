<?php

namespace App\Http\Requests;

use App\Models\MhGereja;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GembalaRequest extends FormRequest
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
            "nik" => "required",
            "no_kk" => "nullable",
            "name" => "required",
            "sex" => ["required", Rule::in("L", "P")],
            "date_birth" => "required|date",
            "place_birth" => "required",
            "blood_group" => "nullable",
            "address" => "required",
            "telp" => "required|numeric",
            "email" => "nullable|email",
            "bank_account_num" => "nullable",
            "bank_account_name" => "nullable",
            "marital_status" => "required|in:S,M,J,D",
            "baptized_at" => "nullable|date",
            "baptized_place" => "nullable",
            "status" => "nullable",
            "sk_no" => "nullable",
            "sk_date" => "nullable|date",
            "mh_gereja_id" => ["nullable", Rule::exists(MhGereja::class, "id")]
        ];
    }
}
