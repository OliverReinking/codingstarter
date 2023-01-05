<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;

    const APPLICATION_ADMIN = "Administration";
    const APPLICATION_COMPANY = "Unternehmen";
    const APPLICATION_CUSTOMER = "Kunde";

    const STATUS_NOT_YET_ACCEPTED = "Einladung wurde noch nicht angenommen";

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($invitation) {
            $rnd = random_int(0, 20000);
            $invitation->uuid = Str::uuid() . '-' . $invitation->id . '-' . $rnd;
            $invitation->save();
        });
    }

    // Eine Teammitglied-Einladung (invitations) gehört zu genau einer Person / einem Unternehmen (person_companies)
    public function person_company()
    {
        return $this->belongsTo('App\Models\PersonCompany', 'person_company_id', 'id');
    }

    public static function carryOutInvitation(
        string $slug,
        string $password = null
    ) {
        $values = collect();
        $values->errorOn = false;
        $values->errorMessage = null;
        //
        $invitation = Invitation::where('uuid', '=', $slug)->first();
        //
        if (!$invitation) {
            $values->errorOn = true;
            $values->errorMessage = "Die Einladung konnte nicht gefunden werden.";
            return $values;
        }
        // prüfe, ob Einladung bereits angenommen wurde
        if ($invitation->status != Invitation::STATUS_NOT_YET_ACCEPTED) {
            $values->errorOn = true;
            $values->errorMessage = "Die Einladung wurde bereits angenommen.";
            return $values;
        }
        // prüfe, ob für die Einladung (invitations.email) bereits ein Anwender (users.email) existiert
        $user = User::where('email', '=', $invitation->email)->first();
        //
        if (!$user) {
            // erstelle neuen Datensatz in Tabelle users
            $user = User::create([
                'first_name' => $invitation->first_name,
                'last_name' => $invitation->last_name,
                'email' => $invitation->email,
                'password' => Hash::make($password),
                'email_verified_at' => Carbon::now(),
            ]);
        }
        //
        //Log::info('Invitation carryOutInvitation', [
        //    'user' => $user,
        //]);
        //
        // führe jetzt in Abhängigkeit von invitations.application weitere Anpassungen vor
        if ($invitation->application == Invitation::APPLICATION_ADMIN) {
            $user->is_admin = true;
            $user->admin_id = $invitation->person_company_id;
            $user->save();
        }
        //
        if ($invitation->application == Invitation::APPLICATION_COMPANY) {
            $user->is_employee = true;
            $user->company_id = $invitation->person_company_id;
            $user->save();
        }
        //
        if ($invitation->application == Invitation::APPLICATION_CUSTOMER) {
            $user->is_customer = true;
            $user->customer_id = $invitation->person_company_id;
            $user->save();
        }
        //
        $invitation->status = "Einladung wurde angenommen am " . formatDateTimeLocale(Carbon::now());
        $invitation->save();
        //
        return $values;
    }
}
