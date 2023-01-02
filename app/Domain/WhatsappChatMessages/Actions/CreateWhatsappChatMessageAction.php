<?php


namespace App\Domain\WhatsappChatMessages\Actions;


use App\Domain\WhatsappChatMessages\DTO\WhatsappChatMessageDTO;
use App\Domain\WhatsappChatMessages\Model\WhatsappChatMessage;

class CreateWhatsappChatMessageAction
{
    public static function execute(WhatsappChatMessageDTO $DTO){
        $chat_message   =   new WhatsappChatMessage($DTO->toArray());
        $chat_message->save();
        return $chat_message;
    }

}
