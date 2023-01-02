<?php


namespace App\Http\ViewModels\WhatsappChats;


use App\Domain\WhatsappChatMessages\Model\WhatsappChatMessage;
use App\Domain\WhtsappChats\Model\WhatsappChat;
use Illuminate\Contracts\Support\Arrayable;

class WhatsappChatMessagesIndexVM implements Arrayable
{
    private $datatable;
    private $chat_id;

    public function __construct($chat_id,$datatable = false)
    {
        $this->datatable = $datatable;
        $this->chat_id  =   $chat_id;
    }

    public function get_chats(){
        $query = WhatsappChatMessage::query()->where('from',$this->chat_id)
        ->orWhere('to',$this->chat_id);
        return $this->datatable ? datatables($query)->make(true) : $query->get();
    }
    public function toArray()
    {
        return $this->get_chats();
    }
}
