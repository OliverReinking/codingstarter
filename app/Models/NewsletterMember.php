<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsletterMember extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();
        static::created(function ($newsletter_member) {
            $rnd = random_int(0, 20000);
            $newsletter_member->uuid = Str::uuid() . '-' . $newsletter_member->id . '-' . $rnd;
            $newsletter_member->save();
        });
    }
}
