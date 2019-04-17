<?php

namespace App\Http\Requests;

use App\Rules\UniquePhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class ProspectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name'                     => 'required|min:3',
            'number_of_employees'              => 'nullable|numeric',
            'contacts'                         => 'min:1',
            'contacts.*.name'                  => 'required',
            'contacts.*.landline_phone_number' => [
                'required_without:contacts.*.mobile_phone_number',
                'nullable',
                'phone:AUTO,GB',
                new UniquePhoneNumber(),
            ],
            'contacts.*.mobile_phone_number'   => [
                'required_without:contacts.*.landline_phone_number',
                'nullable',
                'phone:AUTO,GB',
                new UniquePhoneNumber(),
            ],
            'contacts.*.email'                 => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'contacts.min'                                      => 'There must be at least 1 contact',
            'contacts.*.name.required'                          => 'The contact must have a name',
            'contacts.*.landline_phone_number.required_without' => 'The contact needs a mobile or landline phone number',
            'contacts.*.mobile_phone_number.required_without'   => 'The contact needs a mobile or landline phone number',
            'contacts.*.landline_phone_number.phone'            => 'This is not a valid UK Phone number',
            'contacts.*.mobile_phone_number.phone'              => 'This is not a valid UK Phone number',
            'contacts.*.email.email'                            => 'This is not an email address',
        ];
    }

    public function asd()
    {
    }
}
