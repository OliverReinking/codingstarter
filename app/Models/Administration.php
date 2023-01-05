<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'admin_id';

    const ADMIN_CODINGSTARTER_ID = 1000;

    // Ein Administrator (administrations) gehört zu genau einem Unternehmen (person_companies)
    public function person_company()
    {
        return $this->belongsTo('App\Models\PersonCompany', 'admin_id', 'id');
    }
}
