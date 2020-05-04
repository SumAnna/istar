<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
            'firstname' => 'required|max:64|required|alpha_dash',
			'lastname' => 'required|max:64|required|alpha_dash',
			'phone' => 'required|array',
			'phone.*' => 'max:13|distinct|string|nullable',
        ];
    }
		
	/**
	* Get the error messages for the defined validation rules.
	*
	* @return array
	*/
	public function messages()
	{
		return [
			'distinct' => 'Номер повторяется!',
			'exist' => 'Номер уже существует в телефонной книге!',
		];
	}
}
