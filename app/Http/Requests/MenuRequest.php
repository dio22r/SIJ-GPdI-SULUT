<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
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
        $ruleUniqueCode = Rule::unique(Menu::class, 'code')
            ->whereNull('deleted_at');
        if ($this->menu) {
            $ruleUniqueCode->ignore($this->menu->id);
        }

        return [
            "name" => ["required"],
            "code" => ["required", $ruleUniqueCode],
            "icon" => ["nullable"],
            "order" => ["required"],
            "type" => ["required"],
            "initial_action" => ["required"],
        ];
    }
}
