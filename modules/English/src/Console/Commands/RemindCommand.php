<?php

namespace English\Console\Commands;

use English\Http\Repositories\RemindRepository;
use English\Notifications\RemindNotification;
use App\User;
use Illuminate\Console\Command;

class RemindCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:english';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $remindRepository;

    public function __construct(RemindRepository $remindRepository)
    {
        parent::__construct();

        $this->remindRepository = $remindRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $hour = (int)date('H');
        $minute = (int)date('i');
        logger($hour);
        logger($minute);
        $reminds = $this->remindRepository
            ->with('user')
            ->filterGet(compact('hour', 'minute'));
        logger($reminds);
        foreach ($reminds as $remind) {
            $remind->user->notify(new RemindNotification());
        }



}
}
