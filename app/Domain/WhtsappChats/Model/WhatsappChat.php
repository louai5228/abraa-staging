<?php

namespace App\Domain\WhtsappChats\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhatsappChat extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'whatsapp_chats';

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
