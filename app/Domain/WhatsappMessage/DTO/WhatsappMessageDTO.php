<?php


namespace App\Domain\WhatsappMessage\DTO;


use Spatie\DataTransferObject\DataTransferObject;

class WhatsappMessageDTO extends DataTransferObject
{
    public $id;
    public $message_content;

    public static function fromRequest($request){
        return new self([
            'id'    =>  $request['id'] ??  null,
            'message_content'    =>  $request['message_content'] ??  null,
        ]);
    }

}
