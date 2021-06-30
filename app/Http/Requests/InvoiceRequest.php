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
            'Name' => ['required', Rule::unique('invoices')->ignore($this->id),],
            'counter_id' => 'required',
            'Value' => 'required',
            'Box_id' => 'required',
            'counter_id' => 'required',
        ];
    }
}
