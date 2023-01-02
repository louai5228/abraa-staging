<?php


namespace App\Domain\WhatsappChatMessages\DTO;


use Spatie\DataTransferObject\DataTransferObject;

class WhatsappChatMessageDTO extends DataTransferObject
{
    public $id;
    public $from;
    public $to;
    public $author;
    public $ack;
    public $body;
    public $fromMe;
    public $type;
    public $isForwarded;
    public $isMentioned;
    public $mentionedIds;
    public $quotedMsg;

    public static function fromRequest($request){
        return new self([
            'id'    =>  $request['id']  ??  null,
            'from'    =>  $request['from']  ??  null,
            'to'    =>  $request['to']  ??  null,
            'author'    =>  $request['author']  ??  null,
            'ack'    =>  $request['ack']  ??  null,
            'body'    =>  $request['body']  ??  null,
            'fromMe'    =>  $request['fromMe']  ??  0,
            'type'    =>  $request['type']  ??  null,
            'isForwarded'    =>  $request['isForwarded']  ??  0,
            'isMentioned'    =>  $request['isMentioned']  ??  0,
            'mentionedIds'    =>  $request['mentionedIds']  ??  null,
            'quotedMsg'    =>  $request['quotedMsg']  ??  null,
        ]);
    }

}
