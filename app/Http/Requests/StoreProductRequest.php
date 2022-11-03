<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"=>'required',
            "category_id"=>'required',
            "price"=>'required',
            "stock"=>'required',
            "stock_defective"=>'required',
        ];
    }

    protected function prepareForValidation(){

        $this->merge([
            'product_category_id'=> $this->category_id,
            'price'=> floatval($this->price),
            'stock'=> intval($this->stock),
            'stock_defective'=> intval($this->stock),
             'status'=> $this->status === 'on'
        ]);
    }
}
