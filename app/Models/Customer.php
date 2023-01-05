<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'customer_id';

    // Ein Kunde (customers) gehört zu genau einer Person / Unternehmung (person_companies)
    public function person_company()
    {
        return $this->belongsTo('App\Models\PersonCompany', 'customer_id', 'id');
    }

    // Ein Kunde (customers) gehört zu genau einem Unternehmen (companies)
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'id');
    }
}
