<?php

namespace Tutorial\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Tutorial\Http\Requests\Admin\TutorialCreateRequest;
use Tutorial\Http\Requests\Admin\TutorialUpdateRequest;
use Tutorial\Http\Resources\Admin\TutorialResource;
use Tutorial\Http\Resources\Admin\TutorialResourceCollection;
use Tutorial\Http\Services\Admin\TutorialService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TutorialAdminController extends Controller
{
    private $service;

    public function __construct(TutorialService $service)
    {
        $this->service = $service;
    }

	/**
     * Paginate
     * @group Tutorial
     * @authenticated
     *
     * @queryParam id required The fund id. Example: 1
     *
     * @response {
     * "data": [
     *   {
     *    "id": 10,
     *    "created_at": "2019-09-04 10:43:47",
     *    "updated_at": "2019-09-04 10:43:47"
     *   },
     *   {
     *    "id": 9,
     *    "created_at": "2019-09-04 08:56:43",
     *    "updated_at": "2019-09-04 08:56:43"
     *   }
     *  ],
     *  "links": {
     *     "first": "{url}?page=1",
     *     "last": "{url}?page=1",
     *     "prev": null,
     *     "next": null
     *  },
     *  "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "{url}",
     *     "per_page": 10,
     *     "to": 2,
     *     "total": 2
     *   }
     * }
     */
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->index($input);

           return new TutorialResourceCollection($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Create
     * @group Tutorial
     * @authenticated
     *
     * @bodyParam is_active int required The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function store(TutorialCreateRequest $request)
    {
        try {
            $input = $request->all();
            $tutorial = $this->service->store($input);

            return new TutorialResource($tutorial);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Show
     * @group Tutorial
     * @authenticated
     *
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function show($id)
    {
        try {
            $tutorial = $this->service->show($id);

            return new TutorialResource($tutorial);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group Tutorial
     * @authenticated
     *
     * @bodyParam is_active int optional The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function update(TutorialUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $data = $this->service->update($input, $id);

            return new TutorialResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group Tutorial
     * @authenticated
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function destroy($id)
    {
        try {
            $data = $this->service->destroy($id);

            return new TutorialResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
