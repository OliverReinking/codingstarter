<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarOrder extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id';

    // Eine Webinaranmeldung (webinar_orders) gehört zu einem Webinar (webinars)
    public function webinar()
    {
        return $this->belongsTo('App\Models\Webinar', 'webinar_id', 'id');
    }

    // Die Webinaranmeldung (webinar_orders) gehört zu genau einer Anrede (salutations)
    public function salutation()
    {
        return $this->belongsTo('App\Models\Salutation', 'salutation_id', 'id');
    }

    public function scopeFilterWebinarOrder($query, array $filters)
    {
        if (isset($filters['search']) && trim($filters['search'] !== '')) {
            $search = $filters['search'];
            $query->where('webinarorders.first_name', 'like', '%' . $search . '%')
                ->orWhere('webinarorders.last_name', 'like', '%' . $search . '%')
                ->orWhere('webinarorders.email', 'like', '%' . $search . '%')
                ->orWhere('webinarorders.phone', 'like', '%' . $search . '%');
        }
        //
        return $query;
    }
}
