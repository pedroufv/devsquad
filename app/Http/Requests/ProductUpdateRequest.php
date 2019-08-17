<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $id = $this->route('product');
        return [
            'name' => "required|string|max:64|unique:products,name,{$id},id,deleted_at,NULL",
            'description' => 'required|string',
            'price' => 'required',
            'category_id' => 'required',
        ];
    }
}
