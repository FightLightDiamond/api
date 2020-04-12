<?php


namespace IO\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use IO\Events\PrivateMessageEvent;
use IO\Models\Message;

class ContactAPIController
{
    public function getContacts()
    {
        $authId = auth()->id();

        $contacts = User::where('id', '<>', $authId)->get();

        $ubreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', $authId)
            ->where('is_read', 0)
            ->groupBy('from')
            ->get();

        $contacts = $contacts->map(function ($contact) use ($ubreadIds) {
            $contactUnread = $ubreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    public function getMessageFor($id)
    {
        $userId = auth('api')->id();

        Message::where('from', $id)->where('to', $userId)->update(['is_read' => 1]);

        $messages = Message::where(function ($q) use ($id, $userId) {
           $q->where('from', $userId)
               ->where('to', $id);
        })->orWhere(function ($q) use ($id, $userId) {
            $q->where('from', $id)
                ->where('to', $userId);
        })->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $input = $request->only(['to', 'content']);
        $input['from'] = auth()->id();

        $message = Message::create($input);

        broadcast(new PrivateMessageEvent($message))->toOthers();;
        return response()->json($message);
    }
}
