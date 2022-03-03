<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rule = [];

        $ruleUniqueEmail = Rule::unique(User::class, 'email');
        if ($this->user) {
            $ruleUniqueEmail->ignore($this->user->id);
            $rule = [
                "password" => ["nullable", "confirmed", "min:6"]
            ];
        }

        if (!$this->user) {
            $rule = [
                "password" => ["required", "confirmed", "min:6"]
            ];
        }


        return array_merge([
            'name' => 'required',
            "email" => ["required", "email", $ruleUniqueEmail],
            'roles' => 'required'
        ], $rule);
    }
}
