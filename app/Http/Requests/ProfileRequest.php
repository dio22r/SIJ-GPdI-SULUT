<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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

        $ruleUniqueEmail = Rule::unique(User::class, 'email')
            ->ignore(Auth::id());

        return [
            'name' => 'required',
            "email" => ["required", "email", $ruleUniqueEmail],
            "password" => ["nullable", "confirmed", "min:6"]
        ];
    }
}
