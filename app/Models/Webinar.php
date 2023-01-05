<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Webinar extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $casts = [
        'event_date' => 'date',
    ];

    public function getEventDateAttribute($value)
    {
        if ($value == null) {
            return Carbon::now()->format('Y-m-d');
            //return null;
        }
        return Carbon::parse($value)->format('Y-m-d');
    }

    // Ein Webinar (webinars) gehört zu genau einem Unternehmen (companies)
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }
    // Ein Webinar (webinars) kann viele Anmeldungen (webinar_orders) besitzen
    public function orders()
    {
        return $this->hasMany('App\Models\WebinarOrder', 'webinar_id', 'id');
    }

    public function scopeFilterWebinar($query, array $filters)
    {
        if (isset($filters['search']) && trim($filters['search'] !== '')) {
            $search = $filters['search'];
            $query->where('webinars.title', 'like', '%' . $search . '%')
                ->orWhere('webinars.description', 'like', '%' . $search . '%');
        }
        //
        return $query;
    }
}
