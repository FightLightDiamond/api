<?php

namespace English\Http\Controllers\API;

use English\Http\Repositories\VocabularyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VocabularyAPIController extends Controller
{
    private $repository;

    public function __construct(VocabularyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function import(Request $request)
    {
        $file = $request->all()[0];
        $this->repository->import($file);
        if ($request->ajax()) {
            return response()->json('Import success');
        }
        session()->flash('success', 'Import success');
        return back();
    }

    public function export(Request $request)
    {
        $input = $request->all();
        $this->repository->export($input);
    }

    public function search(Request $request)
    {
        $input = $request->all();

        $vocabularies = $this->repository->myPaginate($input);
        if($request->ajax())
        {
            return view('en::layouts.components.search-table', compact('vocabularies'))
                ->render();
        }
    }
}
