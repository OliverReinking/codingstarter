<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'is_admin', 'is_employee', 'is_customer', 'admin_id', 'company_id', 'customer_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeFilterUser($query, array $filters)
    {
        if (isset($filters['search']) && trim($filters['search'] !== '')) {
            $search = $filters['search'];
            $query->where('users.first_name', 'like', '%' . $search . '%')
                ->orWhere('users.last_name', 'like', '%' . $search . '%')
                ->orWhere('users.email', 'like', '%' . $search . '%');
        }
        //
        return $query;
    }

    public function getFullNameAttribute()
    {
        $name = $this->first_name;

        if (!empty($this->last_name)) {
            $name .= ' ' . $this->last_name;
        }
        return $name;
    }

    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->full_name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&color=ffffff&background=8b5cf6';
    }

    // Ein Anwender (users) kann zu genau einer Administration (administrations) gehören
    public function administration()
    {
        return $this->belongsTo('App\Models\Administration', 'admin_id', 'admin_id');
    }

    // Ein Anwender (users) kann zu genau einer Administration (companiues) gehören
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id', 'company_id');
    }

    // Ein Anwender (users) kann zu genau einem Kunden (customers) gehören
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'customer_id');
    }

    protected static function deleteUserAdmin(int $admin_id)
    {
        $admins = User::where('is_admin', '=', true)
            ->where('admin_id', '=', $admin_id)
            ->get();
        //
        foreach ($admins as $admin) {
            $admin->is_admin = false;
            $admin->admin_id = null;
            $admin->save();
        }
    }

    protected static function deleteUserCompany(int $company_id)
    {
        $companies = User::where('is_employee', '=', true)
            ->where('company_id', '=', $company_id)
            ->get();
        //
        foreach ($companies as $company) {
            $company->is_employee = false;
            $company->company_id = null;
            $company->save();
        }
    }

    protected static function deleteUserCustomer(int $customer_id)
    {
        $customers = User::where('is_customer', '=', true)
            ->where('customer_id', '=', $customer_id)
            ->get();
        //
        foreach ($customers as $customer) {
            $customer->is_customer = false;
            $customer->customer_id = null;
            $customer->save();
        }
    }
}
