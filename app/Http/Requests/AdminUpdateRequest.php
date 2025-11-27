<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "profile" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048",
            "fullname" =>"required|string",
            "password" => "string|min:6"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
