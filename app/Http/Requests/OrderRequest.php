<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'total_payment' => 'required|numeric',
            'cus_name' => 'required|string|max:50',
            'cus_phone' => 'required|string|max:15',
            'product_name' => 'required|string|max:100',
            'client_ip' => 'nullable|string|max:17',
            'note' => 'nullable|string|max:1000',
        ];
    }
}
