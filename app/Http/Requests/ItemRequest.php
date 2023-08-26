<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'codeNo'=>'required',
            'name'=>'required',
            'image'=>'required',
            'price'=>'required',
            'discount'=>'required',
            'instock'=>'required',
            'category_id'=>'required',
            'description'=>'required'
        ];
    }
    public function messages(){
        return [
            'codeNo.required'=> 'CodeNoတော့မချန်ထားနဲ့',
            'name.required'=> 'Nameတော့မချန်ထားနဲ့',
            'image.required'=> 'Imageတော့မချန်ထားနဲ့',
            'price.required'=> 'Priceတော့မချန်ထားနဲ့',
            'discount.required'=> 'Discountတော့မချန်ထားနဲ့',
            'instock.required'=> 'Instockတော့မချန်ထားနဲ့',
            'category_id.required'=> 'Categoryတော့မချန်ထားနဲ့',
            'description.required'=> 'နဲနဲတော့ရေးပေး'

        ];
    }
}
