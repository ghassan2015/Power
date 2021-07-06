<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvoiceRequest extends FormRequest
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
            "current_reading" => "required|array|min:3",
            "current_reading.*" => "required|string|distinct|min:3",
            "Customer_id" => "required|array|min:3",
            "Customer_id.*" => "required|string|distinct|min:3",
            "previous_reading" => "required|array|min:3",
            "previous_reading.*" => "required|string|distinct|min:3",
            "Total" => "required|array|min:3",
            "Total.*" => "required|string|distinct|min:3",
        ];
    }
}
