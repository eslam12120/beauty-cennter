<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            //
            'name_ar' => 'required',
            'name_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'quentaty'=>'required|numeric|min:1',
            'price'=> 'required',
            'special_price'=>'required',
            'discount'=>'nullable',
            'category'=>'required',
            'material'=>'required',
            'image' => 'array|min:1', //[]
            'colors' => 'array|min:1', //[]
            'colors.*' => 'numeric|exists:colors,id',
            'sizes' => 'array|min:1', //[]
            'sizes.*' => 'numeric|exists:sizes,id',
        ];
    }
}
