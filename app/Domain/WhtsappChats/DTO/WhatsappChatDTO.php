<?php


namespace App\Domain\WhtsappChats\DTO;


use Spatie\DataTransferObject\DataTransferObject;

class WhatsappChatDTO extends DataTransferObject
{
    public $id;
    public $name;
    public $isReadOnly;
    public $isGroup;
    public $archived;
    public $pinned;
    public $isMuted;
    public $unread;

    public static function fromRequest($request){
        return new self([
            'id'    =>  $request['id']  ??  null,
            'name'    =>  $request['name']  ??  null,
            'isReadOnly'    =>  $request['isReadOnly']  ??  0,
            'isGroup'    =>  $request['isGroup']  ??  0,
            'archived'    =>  $request['archived']  ??  0,
            'pinned'    =>  $request['pinned']  ??  0,
            'isMuted'    =>  $request['isMuted']  ??  0,
            'unread'    =>  $request['unread']  ??  0,
        ]);
    }

}
