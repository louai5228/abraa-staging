<?php


namespace App\Http\Controllers\WhatsappMessages;

use App\Domain\WhatsappChatMessages\Actions\CreateWhatsappChatMessageAction;
use App\Domain\WhatsappChatMessages\DTO\WhatsappChatMessageDTO;
use App\Domain\WhatsappContacts\Actions\CreateWhatsappContactAction;
use App\Domain\WhatsappContacts\DTO\WhatsappContactDTO;
use App\Domain\WhatsappMessage\Actions\CreateWhatsappMessageAction;
use App\Domain\WhatsappMessage\DTO\WhatsappMessageDTO;
use App\Domain\WhatsappMessage\Model\WhatsappMessage;
use App\Domain\WhtsappChats\Actions\CreateWhatsappChatAction;
use App\Domain\WhtsappChats\DTO\WhatsappChatDTO;
use App\Domain\WhtsappChats\Model\WhatsappChat;
use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\WhatsappChatMessage\CreateWhatsappChatMessageRequest;
use App\Http\Requests\WhatsappChats\CreateWhatsappChatRequest;
use App\Http\Requests\WhatsappChats\GetWhatsappChatMessagesRequest;
use App\Http\Requests\WhatsappMessages\SendMessageRequest;
use App\Http\ViewModels\WhatsappChats\WhatsappChatsIndexVM;
use Illuminate\Http\Request;
use UltraMsg\WhatsAppApi;

class WhatsappController extends Controller
{
    public function send_message(SendMessageRequest $request){

        $data = $request->validated();
        $ultramsg_token=config('constants.whatsapp.token'); // Ultramsg.com token
        $instance_id=config('constants.whatsapp.instance'); // Ultramsg.com instance id
        $client = new WhatsAppApi($ultramsg_token,$instance_id);
        $to=$data['mobile_phone'];
        $body=$data['message'];
        $api=$client->sendChatMessage($to,$body);
        $chat_id = trim($to,'+');
        $chat_id=$chat_id.'@c.us';
        $message = $client->getChatsMessages('963936997540@c.us',1);
        $whatsapp_chat_messageDTO = WhatsappChatMessageDTO::fromRequest($message[0]);
        $whatsapp_chat_messageDTO->mentionedIds=json_encode($whatsapp_chat_messageDTO->mentionedIds);
        $whatsapp_chat_messageDTO->quotedMsg=json_encode($whatsapp_chat_messageDTO->quotedMsg);
        $message=CreateWhatsappChatMessageAction::execute($whatsapp_chat_messageDTO);
        $response = Response::success($message->toArray());
        return \response()->json($response,200);
    }

//    public function get_chats(Request $request){
//        $ultramsg_token=config('constants.whatsapp.token'); // Ultramsg.com token
//        $instance_id=config('constants.whatsapp.instance'); // Ultramsg.com instance id
//        $client = new WhatsAppApi($ultramsg_token,$instance_id);
//        $chats = $client->getChatsMessages('963936997540@c.us',1);
//        return $chats;
//        $response = Response::success($chats);
//        return \response()->json($response,200);
//    }

    public function receive_message(Request $request)
    {
        $input = $request->input();
        $input = json_encode($input);

        $data = [
            'message_content'   =>  $input
        ];
        $whatsapp_message = WhatsappMessageDTO::fromRequest($data);
        $message = CreateWhatsappMessageAction::execute($whatsapp_message);
        $input = json_decode($input,true);
        $whatsapp_chat_messageDTO = WhatsappChatMessageDTO::fromRequest($input['data']);
        $whatsapp_chat_messageDTO->mentionedIds=json_encode($whatsapp_chat_messageDTO->mentionedIds);
        $whatsapp_chat_messageDTO->quotedMsg=json_encode($whatsapp_chat_messageDTO->quotedMsg);
        CreateWhatsappChatMessageAction::execute($whatsapp_chat_messageDTO);
        $chat = WhatsappChat::query()->where('id',$input['data']['from'])->first();
        if (!is_object($chat)){
            $ultramsg_token=config('constants.whatsapp.token'); // Ultramsg.com token
            $instance_id=config('constants.whatsapp.instance'); // Ultramsg.com instance id
            $client = new WhatsAppApi($ultramsg_token,$instance_id);
            $contact = $client->getContact( $input['data']['from']);
            $chat_request = [
                'id'    =>  $input['data']['from'] ,
                'name'  =>  $input['data']['pushname'],
                'isReadOnly'    =>  0,
                'isGroup'    =>  $contact['isGroup'],
                'archived'    =>  0,
                'pinned'    =>  $contact['isBlocked'],
                'isMuted'    =>  $contact['isMuted'],
                'unread'    =>  0,
            ];
            $chatDTO = WhatsappChatDTO::fromRequest($chat_request);
            CreateWhatsappChatAction::execute($chatDTO);
            $contactDTO = WhatsappContactDTO::fromRequest($contact);
            CreateWhatsappContactAction::execute($contactDTO);
        }

    }

    public function create_whatsapp_chat(CreateWhatsappChatRequest $request){
        $data = $request->validated();
        $chatDTO = WhatsappChatDTO::fromRequest($data);
        $chat = CreateWhatsappChatAction::execute($chatDTO);
        $response = Response::success($chat->toArray());
        return \response()->json($response,200);
    }

    public function create_message(CreateWhatsappChatMessageRequest $request){
        $data = $request->validated();
        $messageDTO = WhatsappChatMessageDTO::fromRequest($data);
        $messageDTO->mentionedIds=json_encode($messageDTO->mentionedIds);
        $messageDTO->quotedMsg=json_encode($messageDTO->quotedMsg);
        $message = CreateWhatsappChatMessageAction::execute($messageDTO);
        $response = Response::success($message->toArray());
        return \response()->json($response,200);
    }

    public function get_chats(Request $request){
        $chats = new WhatsappChatsIndexVM($request->datatables);
        $response = Response::success($chats->toArray());
        return \response()->json($response,200);
    }

    public function get_chat_messages(GetWhatsappChatMessagesRequest $request,$id){

    }

}
