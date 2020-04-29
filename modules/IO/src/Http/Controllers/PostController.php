<?php

namespace IO\Http\Controllers;

use IO\Events\PostCreatedEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = (new PostCreatedEvent(['name' => 'fight']));
        broadcast($event)->toOthers();
        return view('io::msg.post');
    }
}
