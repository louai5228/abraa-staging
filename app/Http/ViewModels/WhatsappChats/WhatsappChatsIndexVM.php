<?php


namespace App\Http\ViewModels\WhatsappChats;


use App\Domain\WhtsappChats\Model\WhatsappChat;
use Illuminate\Contracts\Support\Arrayable;

class WhatsappChatsIndexVM implements Arrayable
{
    private $datatable;

    public function __construct($datatable = false)
    {
        $this->datatable = $datatable;
    }

    public function get_chats(){
        $query = WhatsappChat::query();
        return $this->datatable ? datatables($query)->make(true) : $query->get();
    }
    public function toArray()
    {
        return $this->get_chats();
    }
}
