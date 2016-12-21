<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name' => 'required|unique:companies',
            'telephone' => 'required',
            'fax' => 'required',
            'administration' => 'required',
            'taxNumber' => 'required',
            'mersis' => 'required',
            'vat' => 'required',
            'address' => 'required',
            'bankName' => 'required',
            'bankBranch' => 'required',
            'branchNumber' => 'required',
            'accountNumber' => 'required',
            'swiftCode' => 'required',
            'iban' => 'required',
            'branchAddress' => 'required'
        ];
    }
}
