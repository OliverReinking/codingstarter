<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUserType extends Model
{
    use HasFactory;

    const ChatUserType_Customer  = 1;
    const ChatUserType_Company = 2;
    const ChatUserType_Administrator = 3;

    const ChatType_normaleNachricht = 1;

    protected $guarded = [];
}
