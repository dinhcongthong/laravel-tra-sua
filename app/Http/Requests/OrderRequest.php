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
            // order.
            'total_payment' => 'required|numeric|min:0',
            'customer_name' => 'required|string|max:50',
            'customer_phone' => 'required|string|max:15',
            'client_ip' => 'nullable|string|max:17',
            'order_note' => 'nullable|string|max:1000',
        ];
    }
}
