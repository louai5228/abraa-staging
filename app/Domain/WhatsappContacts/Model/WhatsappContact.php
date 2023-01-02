<?php

namespace App\Domain\WhatsappContacts\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhatsappContact extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey='id';
    protected $keyType='string';
    public $incrementing=false;

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
