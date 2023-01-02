<?php


namespace App\Domain\WhatsappContacts\DTO;


use Spatie\DataTransferObject\DataTransferObject;

class WhatsappContactDTO extends DataTransferObject
{
    public $id;
    public $name;
    public $number;
    public $pushname;
    public $isMe;
    public $isGroup;
    public $isBusiness;
    public $isEnterprise;
    public $isMyContact;
    public $isBlocked;
    public $isMuted;

    public static function fromRequest($request){
        return new self([
            'id'    =>  $request['id']    ??    null,
            'name'    =>  $request['name']    ??    null,
            'pushname'    =>  $request['pushname']    ??    null,
            'number'    =>  $request['number']    ??    null,
            'isMe'    =>  $request['isMe']    ??    0,
            'isGroup'    =>  $request['isGroup']    ??    0,
            'isBusiness'    =>  $request['isBusiness']    ??    0,
            'isEnterprise'    =>  $request['isEnterprise']    ??    0,
            'isMyContact'    =>  $request['isMyContact']    ??    0,
            'isBlocked'    =>  $request['isBlocked']    ??    0,
            'isMuted'    =>  $request['isMuted']    ??    0,
        ]);
    }

}
