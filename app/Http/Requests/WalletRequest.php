<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Appp\Models\Wallet;

class WalletRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'sender_email' => 'required|email',
            'sender_wallet' => 'required|string',
            'receiver_email' => 'required|email',
            'receiver_wallet' => 'required|string'
        ];
    }
}
