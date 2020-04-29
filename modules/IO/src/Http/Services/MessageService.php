<?php
/**
 * Created by PhpStorm.
 * User: diamond
 * Date: 3/20/19
 * Time: 11:01 AM
 */

namespace IO\Http\Services;


use IO\Http\Repositories\MessageRepository;

class MessageService
{
    private $messageRepo;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepo = $messageRepo;
    }

    public function paginate($input) {
        $messages = $this->messageRepo
            ->myPaginate($input)
            ->toArray();
        $messages['data'] = array_reverse($messages['data']);
        return $messages;
    }

    public function send($input) {
        $input['from'] = auth()->id();
        $input['to'] = auth()->id();
        $messages = $this->messageRepo->store($input);
        $messages = $messages->toArray();
        $messages['creator'] = auth()->user();

        return $messages;
    }
}
