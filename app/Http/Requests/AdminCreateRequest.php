<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "profile" => "nullable|image|mimes:jpeg,jpg,png,gif|max:2048",
            "username" => "required|string|unique:admins,username",
            "fullname" =>"required|string",
            "password" => "required|string|min:6"
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
