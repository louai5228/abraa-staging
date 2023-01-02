<?php


namespace App\Http\Requests\WhatsappChats;


use App\Http\Requests\ApiFormRequest;

class CreateWhatsappChatRequest extends ApiFormRequest
{
    public function rules()
    {
        return [
            'id'    =>  'string|required',
            'name'    =>  'string|required',
            'isReadOnly'    =>  'integer|nullable',
            'isGroup'    =>  'integer|nullable',
            'archived'    =>  'integer|nullable',
            'pinned'    =>  'integer|nullable',
            'isMuted'    =>  'integer|nullable',
            'unread'    =>  'integer|nullable',
        ];
    }

}
