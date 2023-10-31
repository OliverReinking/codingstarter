<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    const COUNTRY_GERMANY = 84;

    protected $guarded = [];

    protected $primaryKey = 'id';

}
