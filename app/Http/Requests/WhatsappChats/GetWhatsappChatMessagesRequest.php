<?php


namespace App\Http\Requests\WhatsappChats;


use App\Http\Requests\ApiFormRequest;

class GetWhatsappChatMessagesRequest extends ApiFormRequest
{
    public function rules()
    {
       return [
           'id' =>  'string|required|exists:whatsapp_chats,id,deleted_at,NULL'
       ];
    }

}
