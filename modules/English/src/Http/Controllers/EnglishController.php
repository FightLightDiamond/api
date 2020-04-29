<?php

namespace English\Http\Controllers;

use App\Http\Controllers\Controller;
use English\Http\Services\EnglishService;


class EnglishController extends Controller
{
    private $englishService;

    public function __construct(EnglishService $englishService)
    {
        $this->englishService = $englishService;
    }

    public function index()
    {
        try {
            $data = $this->englishService->overview();
            return view('en::english.index', $data);
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return back();
        }
    }
}
