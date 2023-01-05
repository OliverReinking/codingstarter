<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PersonCompany;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonCompanyPolicy
{
    use HandlesAuthorization;

    public function company_crud_person_company(User $user, PersonCompany $person_company)
    {
        //
        //Log::info('company_crud_person_company', [
        //    'user->is_employee' => $user->is_employee,
        //    'user->company_id' => $user->company_id,
        //]);
        //
        return ($user->is_employee && $user->company_id > 0 && $user->company_id === $person_company->id);
    }

    public function customer_crud_person_company(User $user, PersonCompany $person_company)
    {
        //
        //Log::info('customer_crud_person_company', [
        //    'user->is_customer' => $user->is_company,
        //    'user->customer_id' => $user->customer_id,
        //]);
        //
        return ($user->is_customer && $user->customer_id > 0 && $user->customer_id === $person_company->id);
    }
}
