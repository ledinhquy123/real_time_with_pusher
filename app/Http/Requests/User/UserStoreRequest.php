<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $modelUser = get_class(new User);
        return [
            'email' => "required|email|unique:{$modelUser},email",
            'password' => 'required|min:8|confirmed'
        ];
    }
}
