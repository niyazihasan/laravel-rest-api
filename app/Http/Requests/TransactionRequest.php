<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'type' => 'required|in:income,spending',
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric',
            'expense_id' => 'required|exists:expense_categories,id',
            'income_id' => 'required|exists:income_categories,id'
        ];
    }
}
