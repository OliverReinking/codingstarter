<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Jobs\SendMailNewChat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    const Chat_mit_Mailbenachrichtung = true;
    const Chat_ohne_Mailbenachrichtung = false;

    protected $guarded = [];

    protected $primaryKey = 'id';

    protected $casts = [
        'chat_date' => 'datetime',
        'read_date' => 'datetime',
    ];

    // Ein Chat (chats) gehört zu genau einem Sender-Anwender (users)
    public function sender_user()
    {
        return $this->belongsTo('App\Models\User', 'sender_user_id', 'id');
    }

    // Ein Chat (chats) gehört zu genau einem Sender-Unternehmen (companies
    public function sender_company()
    {
        return $this->belongsTo('App\Models\PersonCompany', 'sender_person_company_id', 'id');
    }

    // Ein Chat (chats) kann zu genau einem Sender-Chatusertyp (chat_user_types) gehören
    public function sender_chatusertype()
    {
        return $this->belongsTo('App\Models\ChatUserType', 'sender_chat_type_id', 'id');
    }

    // Ein Chat (chats) kann zu genau einem Absender-Anwender (users) gehören
    public function receiver_user()
    {
        return $this->belongsTo('App\Models\User', 'receiver_user_id', 'id');
    }

    // Ein Chat (chats) kann zu genau einem Absender-Shop (companies) gehören
    public function receiver_company()
    {
        return $this->belongsTo('App\Models\PersonCompany', 'receiver_person_company_id', 'id');
    }

    // Ein Chat (chats) kann zu genau einem Absender-Chatusertyp (chat_user_types) gehören
    public function receiver_chatusertype()
    {
        return $this->belongsTo('App\Models\ChatUserType', 'receiver_chat_type_id', 'id');
    }

    public function scopeFilterCompanyChat($query, array $filters)
    {
        if (isset($filters['search']) && trim($filters['search'] !== '')) {
            $search = $filters['search'];
            $query->where('chats.message', 'like', '%' . $search . '%');
        }
        //
        return $query;
    }

    public static function determineOtherComapny(
        int $my_company_id,
        Chat $chat
    ) {
        $other_company_id = 0;
        //
        if ($chat->sender_person_company_id == $my_company_id) {
            $other_company_id = $chat->receiver_person_company_id;
        }
        //
        if ($chat->receiver_person_company_id == $my_company_id) {
            $other_company_id = $chat->sender_person_company_id;
        }
        //
        return $other_company_id;
    }

    public static function determineChatHistory(
        int $my_chat_type,
        int $my_company_id,
        int $other_company_id
    ) {
        // ermittle jetzt alle zugehörigen Chat-Nachrichten zu den vorgegebenen Werten
        $chathistory = Chat::select([
            'sender_user.first_name as sender_user_first_name',
            'sender_user.last_name as sender_user_last_name',
            'sender_person_company.name as sender_person_company_name',
            'receiver_user.first_name as receiver_user_first_name',
            'receiver_user.last_name as receiver_user_last_name',
            'receiver_person_company.name as receiver_person_company_name',
            'chats.id as id',
            'sender_user_id',
            'sender_person_company_id',
            'sender_user_type_id',
            'receiver_user_id',
            'receiver_person_company_id',
            'receiver_user_type_id',
            'chat_date',
            'message',
            'read_status',
            'read_date'
        ])
            ->leftJoin('users as sender_user', 'sender_user.id', '=', 'chats.sender_user_id')
            ->leftJoin('person_companies as sender_person_company', 'sender_person_company.id', '=', 'chats.sender_person_company_id')
            //
            ->leftJoin('users as receiver_user', 'receiver_user.id', '=', 'chats.receiver_user_id')
            ->leftJoin('person_companies as receiver_person_company', 'receiver_person_company.id', '=', 'chats.receiver_person_company_id')
            // ----------------------------
            // Sender my and Receiver other
            // ----------------------------
            ->where(function ($q) use ($my_company_id, $my_chat_type, $other_company_id) {
                $q->where('receiver_user_type_id', '=', $my_chat_type);
                $q->where('receiver_person_company_id', '=', $my_company_id);
                $q->where('sender_person_company_id', '=', $other_company_id);
            })
            // ----------------------------
            // Sender my and Receiver other
            // ----------------------------
            ->orWhere(function ($q) use ($my_company_id, $my_chat_type, $other_company_id) {
                $q->where('sender_user_type_id', '=', $my_chat_type);
                $q->where('sender_person_company_id', '=', $my_company_id);
                $q->where('receiver_person_company_id', '=', $other_company_id);
            })
            ->orderBy('chat_date', 'DESC')
            ->get();
        //
        return $chathistory;
    }
    //
    public static function determineChatData(Chat $chat)
    {
        $chatData = collect();
        //
        $chatData = $chat;
        //
        $chat_sender_user = $chat->sender_user()->first();
        if ($chat_sender_user) {
            $chatData->sender_user_name = $chat_sender_user->full_name;
        }
        //
        $chat_sender_company = $chat->sender_company()->first(['name']);
        if ($chat_sender_company) {
            $chatData->sender_person_company_name = $chat_sender_company->name;
        }
        //
        $chat_sender_type = $chat->sender_chatusertype()->first(['name']);
        if ($chat_sender_type) {
            $chatData->sender_type_name = $chat_sender_type->name;
        }
        //
        $chat_receiver_user = $chat->receiver_user()->first();
        if ($chat_receiver_user) {
            $chatData->receiver_user_name = $chat_receiver_user->full_name;
        }
        //
        $chat_receiver_company = $chat->receiver_company()->first(['name']);
        if ($chat_receiver_company) {
            $chatData->receiver_person_company_name = $chat_receiver_company->name;
        }
        //
        $chat_receiver_type = $chat->receiver_chatusertype()->first(['name']);
        if ($chat_receiver_type) {
            $chatData->receiver_type_name = $chat_receiver_type->name;
        }
        //
        return $chatData;
    }

    public static function createChat(
        int $chat_type_id,
        int $sender_user_id,
        int $sender_person_company_id,
        int $sender_user_type_id,
        int $receiver_user_id,
        int $receiver_person_company_id,
        int $receiver_user_type_id,
        string $message,
        string $key_value_one = null,
        string $key_value_two = null,
        bool $mailbenachrichtigung = false
    ) {
        $chat_date = Carbon::now();
        //
        $key_value_one = Str::substr($key_value_one, 0, 100);
        $key_value_two = Str::substr($key_value_two, 0, 100);
        //
        $chat = Chat::create([
            'chat_date' => $chat_date,
            'chat_type_id' => $chat_type_id,
            'sender_user_id' => $sender_user_id,
            'sender_person_company_id' => $sender_person_company_id,
            'sender_user_type_id' => $sender_user_type_id,
            'receiver_user_id' => $receiver_user_id,
            'receiver_person_company_id' => $receiver_person_company_id,
            'receiver_user_type_id' => $receiver_user_type_id,
            'message' => $message,
            'key_value_one' => $key_value_one,
            'key_value_two' => $key_value_two,
        ]);
        //
        if ($mailbenachrichtigung) {
            // -------------------------
            // versende Mail MailNewChat
            // -------------------------
            // ermittle Sender-Unternehmen
            $sender_company = PersonCompany::Find($receiver_person_company_id);
            // ermittle Empfänger-Unternehmen
            $receiver_company = PersonCompany::Find($receiver_person_company_id);
            //
            if ($sender_company && $receiver_company) {
                // Ermittle die chat_values
                $chat_values = collect();
                //
                $chat_values->sender_email = $sender_company->email;
                $chat_values->sender_name = $sender_company->name;
                //
                $chat_values->receiver_email = $receiver_company->email;
                $chat_values->receiver_name = $receiver_company->name;
                //
                dispatch(new SendMailNewChat($chat_values));
            }
        }
        //
        return $chat;
    }

    public static function readChat(
        Chat $chat,
        int $company_id,
        int $user_type_id
    ) {
        if ($chat->receiver_user_type_id == $user_type_id && $chat->receiver_person_company_id == $company_id) {
            $read_date = Carbon::now();
            $chat->read_status = true;
            $chat->read_date = $read_date;
            $chat->save();
        }
    }
}
