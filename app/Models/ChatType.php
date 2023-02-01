<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatType extends Model
{
    use HasFactory;

    Const CHATTYPE_NORMALE_NACHRICHT = 1;

    protected $guarded = [];

    protected $primaryKey = 'id';

}
