<?php


namespace App\Domain\WhatsappMessage\Actions;


use App\Domain\WhatsappMessage\DTO\WhatsappMessageDTO;
use App\Domain\WhatsappMessage\Model\WhatsappMessage;

class CreateWhatsappMessageAction
{
    public static function execute(WhatsappMessageDTO $DTO){
        $message = new WhatsappMessage($DTO->toArray());
        $message->save();
        return $message;
    }

}
