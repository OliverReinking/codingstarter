<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'company_id';

    // Ein Unternehmen (companies) gehört zu genau einer Person / Unternehmen (person_companies)
    public function person_company()
    {
        return $this->belongsTo('App\Models\PersonCompany', 'company_id', 'id');
    }
}
