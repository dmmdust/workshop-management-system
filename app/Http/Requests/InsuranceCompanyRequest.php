<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InsuranceCompanyRequest extends Request
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|unique:insurance_companies',
                    'address' => 'required',
                    'telephone' => 'required',
                    'email' => 'email',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required',
                    'address' => 'required',
                    'telephone' => 'required',
                    'email' => 'email',
                ];
            }
            default:break;
        }
    }
}
