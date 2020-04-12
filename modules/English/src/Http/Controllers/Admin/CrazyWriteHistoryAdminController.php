<?php

namespace English\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use English\Http\Requests\Admin\CrazyWriteHistoryCreateRequest;
use English\Http\Requests\Admin\CrazyWriteHistoryUpdateRequest;
use English\Http\Resources\Admin\CrazyWriteHistoryResource;
use English\Http\Resources\Admin\CrazyWriteHistoryResourceCollection;
use English\Http\Services\Admin\CrazyWriteHistoryService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CrazyWriteHistoryAdminController extends Controller
{
    private $service;

    public function __construct(CrazyWriteHistoryService $service)
    {
        $this->service = $service;
    }

	/**
     * Paginate
     * @group CrazyWriteHistory
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

           return new CrazyWriteHistoryResourceCollection($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Create
     * @group CrazyWriteHistory
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
    public function store(CrazyWriteHistoryCreateRequest $request)
    {
        try {
            $input = $request->all();
            $crazyWriteHistory = $this->service->store($input);

            return new CrazyWriteHistoryResource($crazyWriteHistory);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Show
     * @group CrazyWriteHistory
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
            $crazyWriteHistory = $this->service->show($id);

            return new CrazyWriteHistoryResource($crazyWriteHistory);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group CrazyWriteHistory
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
    public function update(CrazyWriteHistoryUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $data = $this->service->update($input, $id);

            return new CrazyWriteHistoryResource($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group CrazyWriteHistory
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

            return new CrazyWriteHistoryResource($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }
}
