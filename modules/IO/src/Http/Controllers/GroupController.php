<?php

namespace IO\Http\Controllers;

use IO\Events\GroupWizzEvent;
use App\Http\Controllers\Controller;
use IO\Notifications\DemoNotification;
use ECommerce\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('users')->get();
        return view('io::group.index', compact('groups'));
    }

    public function notify(int $id) {
        $group = Group::find($id);
        auth()->user()->notify(new DemoNotification($group));
        broadcast(new GroupWizzEvent($group))->toOthers();
        return back();
    }
}
