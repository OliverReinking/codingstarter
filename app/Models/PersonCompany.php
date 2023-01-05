<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonCompany extends Model
{
    use HasFactory;

    Const PERSONCOMPANY_ADMINISTRATOR = "Administrator";
    Const PERSONCOMPANY_COMPANY = "Company";
    Const PERSONCOMPANY_CUSTOMER = "Customer";

    protected $guarded = [];

    protected $primaryKey = 'id';

    // Eine Person / Unternehmen (person_companies) gehört zu genau einem Land (countries)
    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    // Die Rechnungsadresse einer Person / Unternehmen (person_companies) gehört zu genau einem Land (countries)
    public function billingcountry()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'id');
    }

    // Die Kontaktperson einer Peson bzw. eines Unternehmen (person_companies) gehört zu genau einer Anrede (salutations)
    public function salutation()
    {
        return $this->belongsTo('App\Models\Salutation', 'contactperson_salutation_id', 'id');
    }

     // Eine Person / Unternehmen (person_companies) kann zu genau einer Administration (administrations)
     public function admin()
     {
         return $this->belongsTo('App\Models\Administration', 'id', 'admin_id');
     }

    // Eine Person / Unternehmen (person_companies) kann zu genau einer Company (companies)
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'id', 'company_id');
    }

    // Eine Person / Unternehmen (person_companies) kann zu genau einem Kunden (customers)
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id', 'customer_id');
    }

    public function scopeFilterPersonCompany($query, array $filters)
    {
        if (isset($filters['search']) && trim($filters['search'] !== '')) {
            $search = $filters['search'];
            $query->where('person_companies.person_company_number', 'like', '%' . $search . '%')
                ->orWhere('person_companies.name', 'like', '%' . $search . '%')
                ->orWhere('person_companies.postcode', 'like', '%' . $search . '%')
                ->orWhere('person_companies.contactperson_first_name', 'like', '%' . $search . '%')
                ->orWhere('person_companies.contactperson_last_name', 'like', '%' . $search . '%')
                ->orWhere('person_companies.contactperson_email', 'like', '%' . $search . '%');
        }
        //
        return $query;
    }

    // Ermittle Person-Unternehmens-Nr beim Einfügen eines neuen Datensatzes
    public static function booted()
    {
        static::created(function ($person_company) {
            $year = Carbon::now()->year;
            $person_company->person_company_number = $year . '-' . $person_company->id;
            $person_company->save();
        });
    }
}
