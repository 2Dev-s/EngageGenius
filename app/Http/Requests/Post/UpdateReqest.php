<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReqest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            "files" => ["array"],
            "publish_date" => ["required", "date"],
            "socials" => ["array"],
        ];
    }
}
