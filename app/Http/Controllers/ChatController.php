<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Inertia\Inertia;
use App\Models\ChatUserType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ChatController extends Controller
{
    // =================
    // APPLICATION ADMIN
    // =================
    public function admin_chat_inbox_index($filter_read = "all")
    {
        //
        //Log::info('admin_chat_inbox_index', [
        //    'filter_read' => $filter_read,
        //]);
        //
        $user = Auth::user();
        //
        $admin_id = $user->admin_id;
        //
        $chats = ChatController::determineChatList(
            $filter_read,
            true,
            ChatUserType::CHATUSERTYPE_ADMINITRATOR,
            $admin_id
        );
        //
        $filterChatsText = null;
        //
        if ($filter_read == "unread") {
            $filterChatsText = "Es werden alle ungelesenen Nachrichten angezeigt.";
        }
        if ($filter_read == "read") {
            $filterChatsText = "Es werden alle gelesenen Nachrichten angezeigt.";
        }
        //
        return Inertia::render('Application/Admin/ChatInboxList', [
            'chats' => $chats,
            'filterChatsText' => $filterChatsText,
            'filters' => Request::all('search'),
        ]);
    }

    public function admin_chat_inbox_show(Chat $chat)
    {
        $user = Auth::user();
        //
        $admin_id = $user->admin_id;
        //
        Chat::readChat($chat, $admin_id, ChatUserType::CHATUSERTYPE_ADMINITRATOR);
        //
        $other_company_id = Chat::determineOtherComapny($admin_id, $chat);
        //
        $chatData = Chat::determineChatData($chat);
        //
        $chathistory = Chat::determineChatHistory(
            ChatUserType::CHATUSERTYPE_ADMINITRATOR,
            $admin_id,
            $other_company_id
        );
        //
        //Log::info('admin_chat_inbox_show', [
        //    'admin_id' => $admin_id,
        //    'other_company_id' => $other_company_id,
        //]);
        //
        return Inertia::render('Application/Admin/ChatInboxShow', [
            'chat' => $chatData,
            'chathistory' => $chathistory,
        ]);
    }

    public function admin_chat_outbox_index()
    {
        $user = Auth::user();
        //
        $admin_id = $user->admin_id;
        //
        $chats = ChatController::determineChatList(
            "all",
            false,
            ChatUserType::CHATUSERTYPE_ADMINITRATOR,
            $admin_id
        );
        //
        return Inertia::render('Application/Admin/ChatOutboxList', [
            'filters' => Request::all('search'),
            'chats' => $chats,
        ]);
    }

    public function admin_chat_outbox_show(Chat $chat)
    {
        $user = Auth::user();
        //
        $admin_id = $user->admin_id;
        //
        $other_company_id = Chat::determineOtherComapny($admin_id, $chat);
        //
        $chatData = Chat::determineChatData($chat);
        //
        $chathistory = Chat::determineChatHistory(
            ChatUserType::CHATUSERTYPE_ADMINITRATOR,
            $admin_id,
            $other_company_id
        );
        //
        //Log::info('admin_chat_outbox_show', [
        //    'admin_id' => $admin_id,
        //    'other_company_id' => $other_company_id,
        //]);
        //
        return Inertia::render('Application/Admin/ChatOutboxShow', [
            'chat' => $chatData,
            'chathistory' => $chathistory,
        ]);
    }
    // ====================
    // APPLICATION EMPLOYEE
    // ====================
    public function employee_chat_inbox_index($filter_read = "all")
    {
        //
        //Log::info('employee_chat_inbox_index', [
        //    'filter_read' => $filter_read,
        //]);
        //
        $user = Auth::user();
        //
        $company_id = $user->company_id;
        //
        $chats = ChatController::determineChatList(
            $filter_read,
            true,
            ChatUserType::CHATUSERTYPE_COMPANY,
            $company_id
        );
        //
        $filterChatsText = null;
        //
        if ($filter_read == "unread") {
            $filterChatsText = "Es werden alle ungelesenen Nachrichten angezeigt.";
        }
        if ($filter_read == "read") {
            $filterChatsText = "Es werden alle gelesenen Nachrichten angezeigt.";
        }
        //
        return Inertia::render('Application/Employee/ChatInboxList', [
            'chats' => $chats,
            'filterChatsText' => $filterChatsText,
            'filters' => Request::all('search'),
        ]);
    }

    public function employee_chat_inbox_show(Chat $chat)
    {
        $user = Auth::user();
        //
        $company_id = $user->company_id;
        //
        Chat::readChat($chat, $company_id, ChatUserType::CHATUSERTYPE_COMPANY);
        //
        $other_company_id = Chat::determineOtherComapny($company_id, $chat);
        //
        $chatData = Chat::determineChatData($chat);
        //
        $chathistory = Chat::determineChatHistory(
            ChatUserType::CHATUSERTYPE_COMPANY,
            $company_id,
            $other_company_id
        );
        //
        //Log::info('employee_chat_inbox_show', [
        //    'company_id' => $company_id,
        //    'other_company_id' => $other_company_id,
        //]);
        //
        return Inertia::render('Application/Employee/ChatInboxShow', [
            'chat' => $chatData,
            'chathistory' => $chathistory,
        ]);
    }

    public function employee_chat_outbox_index()
    {
        $user = Auth::user();
        //
        $company_id = $user->company_id;
        //
        $chats = ChatController::determineChatList(
            "all",
            false,
            ChatUserType::CHATUSERTYPE_COMPANY,
            $company_id
        );
        //
        return Inertia::render('Application/Employee/ChatOutboxList', [
            'filters' => Request::all('search'),
            'chats' => $chats,
        ]);
    }

    public function employee_chat_outbox_show(Chat $chat)
    {
        $user = Auth::user();
        //
        $company_id = $user->company_id;
        //
        $other_company_id = Chat::determineOtherComapny($company_id, $chat);
        //
        $chatData = Chat::determineChatData($chat);
        //
        $chathistory = Chat::determineChatHistory(
            ChatUserType::CHATUSERTYPE_COMPANY,
            $company_id,
            $other_company_id
        );
        //
        //Log::info('employee_chat_outbox_show', [
        //    'company_id' => $company_id,
        //    'other_company_id' => $other_company_id,
        //]);
        //
        return Inertia::render('Application/Employee/ChatOutboxShow', [
            'chat' => $chatData,
            'chathistory' => $chathistory,
        ]);
    }
    // ====================
    // APPLICATION CUSTOMER
    // ====================
    public function customer_chat_inbox_index($filter_read = "all")
    {
        //
        //Log::info('customer_chat_inbox_index', [
        //    'filter_read' => $filter_read,
        //]);
        //
        $user = Auth::user();
        //
        $customer_id = $user->customer_id;
        //
        $chats = ChatController::determineChatList(
            $filter_read,
            true,
            ChatUserType::CHATUSERTYPE_CUSTOMER,
            $customer_id
        );
        //
        $filterChatsText = null;
        //
        if ($filter_read == "unread") {
            $filterChatsText = "Es werden alle ungelesenen Nachrichten angezeigt.";
        }
        if ($filter_read == "read") {
            $filterChatsText = "Es werden alle gelesenen Nachrichten angezeigt.";
        }
        //
        return Inertia::render('Application/Customer/ChatInboxList', [
            'chats' => $chats,
            'filterChatsText' => $filterChatsText,
            'filters' => Request::all('search'),
        ]);
    }

    public function customer_chat_inbox_show(Chat $chat)
    {
        $user = Auth::user();
        //
        $customer_id = $user->customer_id;
        //
        Chat::readChat($chat, $customer_id, ChatUserType::CHATUSERTYPE_CUSTOMER);
        //
        $other_company_id = Chat::determineOtherComapny($customer_id, $chat);
        //
        $chatData = Chat::determineChatData($chat);
        //
        $chathistory = Chat::determineChatHistory(
            ChatUserType::CHATUSERTYPE_CUSTOMER,
            $customer_id,
            $other_company_id
        );
        //
        //Log::info('customer_chat_inbox_show', [
        //    'customer_id' => $customer_id,
        //    'other_company_id' => $other_company_id,
        //]);
        //
        return Inertia::render('Application/Customer/ChatInboxShow', [
            'chat' => $chatData,
            'chathistory' => $chathistory,
        ]);
    }

    public function customer_chat_outbox_index()
    {
        $user = Auth::user();
        //
        $customer_id = $user->customer_id;
        //
        $chats = ChatController::determineChatList(
            "all",
            false,
            ChatUserType::CHATUSERTYPE_CUSTOMER,
            $customer_id
        );
        //
        return Inertia::render('Application/Customer/ChatOutboxList', [
            'filters' => Request::all('search'),
            'chats' => $chats,
        ]);
    }

    public function customer_chat_outbox_show(Chat $chat)
    {
        $user = Auth::user();
        //
        $customer_id = $user->customer_id;
        //
        $other_company_id = Chat::determineOtherComapny($customer_id, $chat);
        //
        $chatData = Chat::determineChatData($chat);
        //
        $chathistory = Chat::determineChatHistory(
            ChatUserType::CHATUSERTYPE_CUSTOMER,
            $customer_id,
            $other_company_id
        );
        //
        //Log::info('customer_chat_outbox_show', [
        //    'customer_id' => $customer_id,
        //    'other_company_id' => $other_company_id,
        //]);
        //
        return Inertia::render('Application/Customer/ChatOutboxShow', [
            'chat' => $chatData,
            'chathistory' => $chathistory,
        ]);
    }
    // ------
    // SHARED
    // ------
    public static function determineChatList(
        string $filter_read,
        bool $inbox,
        int $user_type,
        int $company_id
    ) {
        $chats = Chat::select(
            'chats.id as id',
            'chats.message as message',
            'chats.chat_date as chat_date',
            'chats.read_status as read_status',
            //
            'sender.id as sender_user_id',
            'sender.first_name as sender_user_first_name',
            'sender.last_name as sender_user_last_name',
            'sender_person_company.id as sender_person_company_id',
            'sender_person_company.name as sender_person_company_name',
            'sendertype.id as sender_type_id',
            'sendertype.name as sender_type_name',
            //
            'receiver.id as receiver_user_id',
            'receiver.first_name as receiver_user_first_name',
            'receiver.last_name as receiver_user_last_name',
            'receiver_person_company.id as receiver_person_company_id',
            'receiver_person_company.name as receiver_person_company_name',
            'receivertype.id as receiver_type_id',
            'receivertype.name as receiver_type_name',
            //
            'type.id as chat_type_id',
            'type.name as chat_type_name',
        )
            //
            ->leftJoin('users AS sender', 'sender.id', '=', 'chats.sender_user_id')
            ->leftJoin('person_companies AS sender_person_company', 'sender_person_company.id', '=', 'chats.sender_person_company_id')
            ->join('chat_user_types AS sendertype', 'sendertype.id', '=', 'chats.sender_user_type_id')
            //
            ->leftJoin('users AS receiver', 'receiver.id', '=', 'chats.receiver_user_id')
            ->leftJoin('person_companies AS receiver_person_company', 'receiver_person_company.id', '=', 'chats.receiver_person_company_id')
            ->join('chat_user_types AS receivertype', 'receivertype.id', '=', 'chats.receiver_user_type_id')
            //
            ->join('chat_types AS type', 'type.id', '=', 'chats.chat_type_id')
            //
            ->where(function ($q) use ($inbox, $user_type, $company_id) {
                if ($inbox) {
                    $q->where('chats.receiver_user_type_id', '=', $user_type);
                    $q->where('chats.receiver_person_company_id', '=', $company_id);
                }
                if (!$inbox) {
                    $q->where('chats.sender_user_type_id', '=', $user_type);
                    $q->where('chats.sender_person_company_id', '=', $company_id);
                }
            })
            ->where(function ($q) use ($filter_read) {
                if ($filter_read == "unread") {
                    $q->where('chats.read_status', '=', false);
                }
                if ($filter_read == "read") {
                    $q->where('chats.read_status', '=', true);
                }
            })
            //
            ->filterCompanyChat(Request::only('search'))
            ->orderBy('chat_date', 'DESC')
            ->paginate(10)
            ->withQueryString();
        //
        return $chats;
    }
}
