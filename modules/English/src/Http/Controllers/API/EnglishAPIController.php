<?php

namespace English\Http\Controllers\API;

use App\Http\Controllers\Controller;
use English\Http\Resources\MasterResource;
use English\Http\Services\EnglishService;

/**
 * Class EnglishAPIController
 * @package English\Http\Controllers\API
 */
class EnglishAPIController extends Controller
{
    /**
     * @var EnglishService
     */
    private $englishService;

    /**
     * EnglishAPIController constructor.
     * @param EnglishService $englishService
     */
    public function __construct(EnglishService $englishService)
    {
        $this->englishService = $englishService;
    }

    /**
     * @return MasterResource|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = $this->englishService->overview();
            return new MasterResource($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
