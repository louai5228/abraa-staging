<?php


namespace App\Domain\WhtsappChats\Actions;


use App\Domain\WhtsappChats\DTO\WhatsappChatDTO;
use App\Domain\WhtsappChats\Model\WhatsappChat;

class CreateWhatsappChatAction
{
    public static function execute(WhatsappChatDTO $DTO){
        $chat = new WhatsappChat($DTO->toArray());
        $chat->save();
        return $chat;
    }

}
