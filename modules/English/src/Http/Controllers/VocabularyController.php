<?php

namespace English\Http\Controllers;

use English\Http\Repositories\VocabularyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class VocabularyController
 * @package English\Http\Controllers\Involve
 */
class VocabularyController extends Controller
{
    /**
     * @var VocabularyRepository
     */
    private $repository;

    /**
     * VocabularyController constructor.
     * @param VocabularyRepository $repository
     */
    public function __construct(VocabularyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return array|string
     * @throws \Throwable
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $vocabularies = $this->repository->myPaginate($input);
        if ($request->ajax()) {
            return view('en::layouts.components.search-table', compact('vocabularies'))
                ->render();
        }
    }
}
