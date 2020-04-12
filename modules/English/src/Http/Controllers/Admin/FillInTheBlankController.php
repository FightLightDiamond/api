<?php

namespace English\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Facades\InputFa;
use English\Models\FillInTheBlank;
use English\Http\Requests\FillInTheBlankCreateRequest;
use English\Http\Requests\FillInTheBlankUpdateRequest;
use English\Http\Repositories\FillInTheBlankRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class FillInTheBlankController extends Controller
{
    use ControllersTrait;
    private $repository;
    public function __construct(FillInTheBlankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data['fillInTheBlanks'] = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('en::admin.fill-in-the-blank.table', $data)->render();
        }
        return view('en::admin.fill-in-the-blank.index', $data);
    }

    public function create()
    {
        return view('en::admin.fill-in-the-blank.create');
    }

    public function store(FillInTheBlankCreateRequest $request)
    {
        $input = $request->all();
        $this->repository->store($input);
        session()->flash('success', 'create success');
        return redirect()->route('admin.fill-in-the-blanks.index');
    }

    public function show($id)
    {
        $fillInTheBlank = $this->repository->find($id);
        if(empty($fillInTheBlank))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.fill-in-the-blank.show', compact('fillInTheBlank'));
    }

    public function edit($id)
    {
        $fillInTheBlank = $this->repository->find($id);
        if(empty($fillInTheBlank))
        {
            session()->flash('error', 'not found');
            return back();
        }
        return view('en::admin.fill-in-the-blank.update', compact('fillInTheBlank'));
    }

    public function update(FillInTheBlankUpdateRequest $request, $id)
    {
        $input = $request->all();
        $fillInTheBlank = $this->repository->find($id);
        if(empty($fillInTheBlank))
        {
            session()->flash('error', 'not found');
            return back();
        }
        $this->repository->change($input, $fillInTheBlank);
        session()->flash('success', 'update success');
        return redirect()->route('admin.fill-in-the-blanks.index');
    }

    public function destroy($id)
    {
        $fillInTheBlank = $this->repository->find($id);
        if(empty($fillInTheBlank))
        {
            session()->flash('error', 'not found');
        }
        $this->repository->delete($id);
        session()->flash('success', 'delete success');
        return back();
    }
}
