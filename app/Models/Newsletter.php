<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Newsletter extends Model
{
    use HasFactory;

    const Newsletter_Platform = 1;

    protected $guarded = [];

    protected $primaryKey = 'id';

    // Ein Newsletter (newsletter) kann viele Abonnenten (newsletter_members) besitzen
    public function newsletter_members()
    {
        return $this->hasMany('App\Models\NewsletterMember', 'newsletter_id', 'id');
    }

    public function scopeFilterNewsletter($query, array $filters)
    {
        if (isset($filters['search']) && trim($filters['search'] !== '')) {
            $search = $filters['search'];
            $query->where('newsletters.name', 'like', '%' . $search . '%');
        }
        //
        return $query;
    }
}
