<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'email'=>'required|unique:users',
            'role'=>'required',
            'phone_no'=>'required',
            'address'=>'required',
            'password'=>'min:8|confirmed',
            'password_confirmation'=>'required|same:password'

        ];
    }
    public function messages(){
        return [
            'name.required'=>'Nameလိုတယ်နော်',
            'email.required'=>'Emailလိုတယ်နော်',
            'role.required'=>'Roleလိုတယ်နော်',
            'phone_no.required'=>'Phone Numberလိုတယ်နော်',
            'address.required'=>'Addressလိုတယ်နော်',
            'password.required'=>'Passwordလိုတယ်နော်',
            'password_confirmation.required'=>'password နဲ့တူအောင်ရေး'
        ];
    }
}