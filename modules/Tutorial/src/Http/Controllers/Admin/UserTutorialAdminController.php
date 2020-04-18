<?php

namespace Tutorial\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Tutorial\Http\Requests\Admin\UserTutorialCreateRequest;
use Tutorial\Http\Requests\Admin\UserTutorialUpdateRequest;
use Tutorial\Http\Resources\Admin\UserTutorialResource;
use Tutorial\Http\Resources\Admin\UserTutorialResourceCollection;
use Tutorial\Http\Services\Admin\UserTutorialService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserTutorialAdminController extends Controller
{
    private $service;

    public function __construct(UserTutorialService $service)
    {
        $this->service = $service;
    }

	/**
     * Paginate
     * @group UserTutorial
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
     *     "'per_page'": 10,
     *     "to": 2,
     *     "total": 2
     *   }
     * }
     */
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $user_tutorials = $this->service->index($input);
            return view('tut::user-tutorial.index', compact('user_tutorials'));
//           return new UserTutorialResourceCollection($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function create()
    {
        return view('tut::user-tutorial.create');
    }

	/**
     * Create
     * @group UserTutorial
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
    public function store(UserTutorialCreateRequest $request)
    {
        try {
            $input = $request->all();
            $userTutorial = $this->service->store($input);
            session()->flash('success', 'Assign success');
//            return new UserTutorialResource($userTutorial);
        } catch (\Exception $exception) {
            logger($exception);
            session()->flash('error', $exception->getMessage());
//            return response()->json($exception->getMessage(), 500);
        }

        return back();
    }

	/**
     * Show
     * @group UserTutorial
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
            $userTutorial = $this->service->show($id);

            return new UserTutorialResource($userTutorial);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group UserTutorial
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
    public function update(UserTutorialUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $data = $this->service->update($input, $id);

            return new UserTutorialResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group UserTutorial
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
            $this->service->destroy($id);
            session()->flash('success', 'Reject success');
//            return new UserTutorialResource($data);
        } catch (\Exception $exception) {
            logger($exception);
//            return response()->json($exception->getMessage(), 500);
            session()->flash('error', $exception->getMessage());
        }

        return back();
    }
}
