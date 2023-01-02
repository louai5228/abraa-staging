<?php


namespace App\Http\Requests\WhatsappMessages;


use App\Http\Requests\ApiFormRequest;

class SendMessageRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'mobile_phone'  =>  'string|required',
            'message'   =>  'string|required',
        ];
    }

}
