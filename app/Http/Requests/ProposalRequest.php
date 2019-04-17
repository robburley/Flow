<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProposalRequest extends FormRequest
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
            'contact_id' => 'required',

            'airtime' => 'min:1',
            'totals'  => 'min:1',

            'airtime.*.tariff'   => 'required',
            'airtime.*.minutes'  => 'required',
            'airtime.*.texts'    => 'required',
            'airtime.*.data'     => 'required',
            'airtime.*.term'     => 'required|numeric',
            'airtime.*.quantity' => 'required|numeric',
            'airtime.*.price'    => 'required|numeric',

            'credits.*.type'        => 'required',
            'credits.*.description' => 'required',
            'credits.*.quantity'    => 'required|numeric',
            'credits.*.price'       => 'required|numeric',

            'hardware.*.manufacturer' => 'required',
            'hardware.*.model'        => 'required',
            'hardware.*.quantity'     => 'required|numeric',
            'hardware.*.upfront'      => 'required|numeric',
            'hardware.*.monthly'      => 'required|numeric',

            'totals.*.product' => 'required',
            'totals.*.term'    => 'required|numeric',
            'totals.*.upfront' => 'required|numeric',
            'totals.*.monthly' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'airtime.min' => 'There must be at least one row of airtime',
            'totals.min'  => 'There must be at least one row of totals',
        ];
    }

    public function asd()
    {
    }
}
