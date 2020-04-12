<?php


namespace Tutorial\Http\Controllers\Admin;


use Tutorial\Http\Repositories\TutorialRepository;
use Tutorial\Http\Services\Admin\ManagerUserTutorialService;

class MangerUserTutorialAdminController
{
    protected $managerUserTutorialService;

    public function __construct(ManagerUserTutorialService $managerUserTutorialService)
    {
        $this->managerUserTutorialService = $managerUserTutorialService;
    }

    public function managerUsers($id)
    {
        try {
            $data = $this->managerUserTutorialService->getUserAssign($id);
            return view('tut::tutorial.manager-user', $data);
        } catch (\Exception $exception) {
            logger($exception);
            session()->flash('error', $exception->getMessage());
            return back();
        }
    }
}
