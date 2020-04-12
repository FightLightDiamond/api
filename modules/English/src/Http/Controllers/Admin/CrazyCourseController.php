<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use English\Http\Requests\CrazyCourseCreateRequest;
use English\Http\Requests\CrazyCourseUpdateRequest;
use English\Http\Repositories\CrazyCourseRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class CrazyCourseController extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(CrazyCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['crazyCourses'] = $this->repository
            ->myPaginate($input);
        if ($request->ajax()) {
            return view('en::admin.crazy-course.table', $data)->render();
        }
        return view('en::admin.crazy-course.index', $data);
    }

    public function create()
    {
        return view('en::admin.crazy-course.create');
    }

    public function store(CrazyCourseCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admin.crazy-courses.index');
    }

    public function show($id)
    {
        $data = $this->repository->edit($id);
        if (empty($data)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-course.show', $data);
    }

    public function edit($id)
    {
        $data = $this->repository->edit($id);
        if (empty($data)) {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.crazy-course.update', $data);
    }

    public function update(CrazyCourseUpdateRequest $request, $id)
    {
        $input = $request->all();
        $crazyCourse = $this->repository->find($id);
        if (empty($crazyCourse)) {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $crazyCourse);
        session()->flash('success', 'update success');
        return redirect()->route('admin.crazy-courses.index');
    }

    public function destroy($id)
    {
        $crazyCourse = $this->repository->find($id);
        if (empty($crazyCourse)) {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
