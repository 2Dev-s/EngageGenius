<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->user()->currentTeam->id !== null) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "title" =>  ["required", "string"],
            "description" =>  ["required", "string"],
            "tags" => ["nullable", "array"],
            "publish_date" => ["required", "date"],
            "socials" => ["array"],
        ];
    }
}
