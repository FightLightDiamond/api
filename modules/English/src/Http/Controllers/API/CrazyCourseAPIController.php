<?php

namespace English\Http\Controllers\API;


use App\Http\Controllers\Controller;
use English\Http\Requests\API\CrazyCourseCreateRequest;
use English\Http\Requests\API\CrazyCourseUpdateRequest;
use English\Http\Resources\API\CrazyCourseResource;
use English\Http\Resources\API\CrazyCourseResourceCollection;
use English\Http\Services\API\CrazyCourseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CrazyCourseAPIController extends Controller
{
    private $service;

    public function __construct(CrazyCourseService $service)
    {
        $this->service = $service;
    }

    /**
     * Paginate
     * @group CrazyCourse
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

            return CrazyCourseResource::collection($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Create
     * @group CrazyCourse
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
    public function store(CrazyCourseCreateRequest $request)
    {
        try {
            $input = $request->all();
            $crazyCourse = $this->service->store($input);

            return response()->json(new CrazyCourseResource($crazyCourse));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Show
     * @group CrazyCourse
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
            $crazyCourse = $this->service->show($id, auth('api')->id());

            return response()->json(new CrazyCourseResource($crazyCourse));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group CrazyCourse
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
    public function update(CrazyCourseUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $crazyCourse = $this->service->update($input, $id);

            return response()->json(new CrazyCourseResource($crazyCourse));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group CrazyCourse
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
            $crazyCourse = $this->service->destroy($id);

            return response()->json(new CrazyCourseResource($crazyCourse));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
