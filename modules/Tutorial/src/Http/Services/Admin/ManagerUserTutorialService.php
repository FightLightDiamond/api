<?php


namespace Tutorial\Http\Services\Admin;


use Tutorial\Http\Repositories\TutorialRepository;
use Tutorial\Http\Repositories\UserTutorialRepository;
use Tutorial\Models\UserTutorial;

class ManagerUserTutorialService
{
    protected $tutorialRepository, $userTutorialRepository;

    public function __construct(TutorialRepository $tutorialRepository, UserTutorialRepository $userTutorialRepository)
    {
        $this->tutorialRepository = $tutorialRepository;
        $this->userTutorialRepository = $userTutorialRepository;
    }

    public function getUserAssign($id)
    {
        UserTutorial::firstOrCreate(['user_id' => 1, 'tutorial_id' => $id]);

        $tutorial = $this->tutorialRepository
            ->with(['userTutorials', 'userTutorials.user:id,identity,email,phone_number,first_name,last_name,is_active'])
            ->find($id);

        $userIds = $this->userTutorialRepository->filterOneList(['tutorial_id'], 'user_id')->toArray();

        return compact('tutorial' , 'userIds');
    }
}
