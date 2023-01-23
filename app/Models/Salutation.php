<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salutation extends Model
{
    use HasFactory;

    const SALUTATION_MALE = 1;
    const SALUTATION_FEMALE = 2;
    const SALUTATION_DIVERS = 3;

    protected $guarded = [];

    protected $primaryKey = 'id';
}
