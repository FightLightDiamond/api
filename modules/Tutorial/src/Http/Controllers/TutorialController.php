<?php

namespace Tutorial\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Cuongpm\Modularization\Facades\InputFa;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;
use Tutorial\Http\Repositories\UserTutorialRepository;
use Tutorial\Models\Tutorial;
use Tutorial\Http\Requests\TutorialCreateRequest;
use Tutorial\Http\Requests\TutorialUpdateRequest;
use Tutorial\Http\Repositories\TutorialRepository;
use Illuminate\Http\Request;
use Tutorial\Models\UserTutorial;

class TutorialController extends Controller
{
    private $repository;

    private $columns = [
        'name' => '', 'is_active' => ''
    ];

    public function __construct(TutorialRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();

        if (\request('sort')) {
            $sorts = explode("|", \request('sort'));
            $this->columns[$sorts[0]] = $sorts[1];
        }

        $data['columns'] = $this->columns;

        $data['tutorials'] = $this->repository->myPaginate($input);

        if ($request->ajax()) {
            return view('tut::tutorial.table', $data)->render();
        }

        return view('tut::tutorial.index', $data);
    }

    public function searchList(Request $request)
    {
        $input = $request->all();
        $data['tutorials'] = $this->repository->myPaginate($input);

        return view('tut::user-tutorial.modals.create.tables.tutorial', $data)->render();
    }

    public function create()
    {
        return view('tut::tutorial.create');
    }

    public function store(TutorialCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');

        if (isset($input['is_back'])) {
            return back();
        }

        return redirect()->route('tutorial.index');
    }

    public function show($id)
    {
        $tutorial = $this->repository->find($id);

        return view('tut::tutorial.show', compact('tutorial'));
    }

    public function managerUsers($id)
    {
        UserTutorial::firstOrCreate(['user_id' => 1, 'tutorial_id' => $id]);

        $tutorial = $this->repository
            ->with(['userTutorials', 'userTutorials.user:id,identity,email,phone_number,first_name,last_name,is_active'])
            ->find($id);

        $user_ids = app(UserTutorialRepository::class)->filterOneList(['tutorial_id'], 'user_id');

        return view('tut::tutorial.manager-user', compact('tutorial' , 'user_ids'));
    }

    public function edit($id)
    {
        $tutorial = $this->repository->find($id);

        if (empty($tutorial)) {
            session()->flash('error', 'not found');
            return back();
        }

        $sections = $tutorial->sections()->orderBy('no')->pluck('name', 'id');

        return view('tut::tutorial.update', compact('tutorial', 'sections'));
    }

    public function update(TutorialUpdateRequest $request, $id)
    {
        $input = $request->all();
        $tutorial = $this->repository->find($id);

        if (empty($tutorial)) {
            session()->flash('error', 'not found');
            return back();
        }

        $this->repository->change($input, $tutorial);

        if (isset($input['is_back'])) {
            return back();
        }
        session()->flash('success', 'update success');

        return redirect()->route('tutorial.index');
    }

    public function destroy($id)
    {
        $tutorial = $this->repository->destroy($id);

        if (\request()->ajax()) {
            return response()->json($tutorial);
        }

        return back();
    }
}
