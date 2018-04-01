<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromotionRequest extends FormRequest
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
            'activity_start_date' => 'required|max:10|date_format:"Y-m-d"|unique:promotions',
            'activity_end_date'   => 'nullable|max:10|date_format:"Y-m-d"|after:activity_start_date',
            'purchase_start_date' => 'required|max:10|date_format:"Y-m-d"|unique:promotions',
            'purchase_end_date'   => 'nullable|max:10|date_format:"Y-m-d"|after:purchase_start_date',
            'rate_type' => 'required|integer',
            'amount' => 'required|numeric',
        ];
    }
}
