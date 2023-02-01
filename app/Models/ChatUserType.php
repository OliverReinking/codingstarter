<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatUserType extends Model
{
    use HasFactory;

    const CHATUSERTYPE_CUSTOMER  = 1;
    const CHATUSERTYPE_COMPANY = 2;
    const CHATUSERTYPE_ADMINITRATOR = 3;

    protected $guarded = [];
}
