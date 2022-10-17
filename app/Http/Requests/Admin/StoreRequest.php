<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
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
        if ($request->isMethod('POST')) {
            return [
                'name' => 'required|string|max:50',
                'address' => 'required|string|max:255',
                'note' => 'nullable',
                'store_status_id' => 'required|exists:store_status,id',
                'store_img' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ];
        }
        return [];
    }
}
