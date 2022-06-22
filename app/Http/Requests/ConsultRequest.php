<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultRequest extends FormRequest
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
            'name' => 'required',
            'family' => 'required',
            'national_code' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'field_id' => 'required',
            'university_id' => 'required',
            'year_id' => 'required',
            'file.*' => 'mimes:jpg,bmp,png'
        ];
    }
}
