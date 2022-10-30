<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

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
    public function rules(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'store_id' => 'nullable|numeric',
            'crawl_id' => 'nullable|numeric',
            'price' => 'required|numeric',
            'description' => 'nullable|string|max:1000',
            'product_status_id' => 'required|exists:product_status,id',
        ];
        if (is_null($request->product_id)) {
            $rules['product_img'] = 'mimes:jpeg,jpg,png,gif|required|max:10000';
        }
        return $rules;
    }
}
