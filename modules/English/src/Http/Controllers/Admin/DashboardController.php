<?php


namespace English\Http\Controllers\Admin;


use ACL\Http\Repositories\UserRepository;
use ACL\Models\Contact;
use App\User;
use English\Http\Repositories\CrazyCourseRepository;
use English\Http\Repositories\CrazyRepository;
use English\Models\Crazy;
use English\Models\CrazyCourse;
use English\Models\CrazyReadHistory;
use English\Models\CrazyWriteHistory;
use English\Models\Vocabulary;

class DashboardController
{
    public function index()
    {
        $data['user'] = User::count();
        $data['course'] = CrazyCourse::count();
        $data['lesson'] = Crazy::count();
        $data['read_history'] = CrazyReadHistory::count();
        $data['write_history'] = CrazyWriteHistory::count();
        $data['contact'] = Contact::count();

        return response()->json($data);
    }
}
