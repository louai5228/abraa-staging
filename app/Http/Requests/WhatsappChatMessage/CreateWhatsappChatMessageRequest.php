<?php


namespace App\Http\Requests\WhatsappChatMessage;


use App\Http\Requests\ApiFormRequest;

class CreateWhatsappChatMessageRequest extends ApiFormRequest
{
    public function rules()
    {
        return[
            'id'    =>  'string|required',
            'from'    =>  'string|required',
            'to'    =>  'string|required',
            'author'    =>  'string|nullable',
            'ack'    =>  'string|nullable',
            'body'    =>  'string|required',
            'fromMe'    =>  'integer|required',
            'type'    =>  'string|required',
            'isForwarded'    =>  'integer|required',
            'isMentioned'    =>  'integer|required',
            'mentionedIds'    =>  'array|nullable',
            'quotedMsg'    =>  'array|nullable',
        ];
    }

}
