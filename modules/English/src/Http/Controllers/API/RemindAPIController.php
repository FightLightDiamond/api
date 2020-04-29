<?php

namespace English\Http\Controllers\API;


use App\Http\Controllers\Controller;
use English\Http\Requests\API\RemindCreateRequest;
use English\Http\Requests\API\RemindUpdateRequest;
use English\Http\Resources\API\RemindResource;
use English\Http\Resources\Admin\RemindResourceCollection;
use English\Http\Services\API\RemindService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RemindAPIController extends Controller
{
    private $service;

    public function __construct(RemindService $service)
    {
        $this->service = $service;
    }

    /**
     * Paginate
     * @group Remind
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
            $remind = auth('api')->user()->remind;

            return new RemindResource($remind);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Create
     * @group Remind
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
    public function store(RemindCreateRequest $request)
    {
        try {
            $input = $request->only('hour', 'minute');
            $input['user_id'] = auth('api')->id();
            $remind = $this->service->store($input);

            return new RemindResource($remind);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Show
     * @group Remind
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
            $remind = $this->service->show($id);

            return new RemindResource($remind);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Update
     * @group Remind
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
    public function update(RemindUpdateRequest $request, $id)
    {
        $input = $request->only('hour', 'minute');
        $input['user_id'] = auth('api')->id();
        try {
            $data = $this->service->update($input, $id);


            return new RemindResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    /**
     * Destroy
     * @group Remind
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

            return new RemindResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
