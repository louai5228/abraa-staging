<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsappMessages\WhatsappController;

Route::group(['prefix' => 'whatsapp'],
    function () {
        Route::post('send_message', [WhatsappController::class,'send_message']);
        Route::post('receive_message', [WhatsappController::class,'receive_message']);
        Route::post('create_whatsapp_chat', [WhatsappController::class,'create_whatsapp_chat']);
        Route::post('create_message', [WhatsappController::class,'create_message']);
        Route::get('get_chats', [WhatsappController::class,'get_chats']);
        Route::get('get_chat_messages', [WhatsappController::class,'get_chat_messages']);
    });
