<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
            'Name' => ['required', 'string', 'max:255'],
            'Phone' => ['string', 'required', 'min:10', 'max:10'],
            'Price' => ['required'],
            'State_id' => ['required'],
            'Address' => ['required'],
            'Box_id' => ['required'],
            'Counter_id' => ['required'],
            'Email' => ['required', 'email', Rule::unique('customers')->ignore($this->id),],
        ];
    }
}
