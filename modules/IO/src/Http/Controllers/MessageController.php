<?php

namespace IO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use IO\Http\Services\MessageService;
use IO\Events\MessageEvent;

class MessageController extends Controller
{
    private $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $messages = $this->messageService->paginate($input);

        return view('io::msg.chat', compact('messages'));
    }

    public function send(Request $request)
    {
        $input = $request->all();
        $messages = $this->messageService->send($input);

//        event(new MessageEvent($messages));
        $event = new MessageEvent($messages);
        broadcast($event)->toOthers();
        return response()->json($messages);
    }
}
