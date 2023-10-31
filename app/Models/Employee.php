<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasApiTokens;
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $hidden = ['api_token'];

    public static function findByApiToken($apiToken)
    {
        $hashedToken = hash('sha256', $apiToken);
        //
        return static::where('api_token', $hashedToken)->first();
    }

}
