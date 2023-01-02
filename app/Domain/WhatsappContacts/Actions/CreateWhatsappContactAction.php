<?php


namespace App\Domain\WhatsappContacts\Actions;


use App\Domain\WhatsappContacts\DTO\WhatsappContactDTO;
use App\Domain\WhatsappContacts\Model\WhatsappContact;

class CreateWhatsappContactAction
{
    public static function execute(WhatsappContactDTO $DTO){
        $contact = new WhatsappContact($DTO->toArray());
        $contact->save();
        return $contact;
    }

}
