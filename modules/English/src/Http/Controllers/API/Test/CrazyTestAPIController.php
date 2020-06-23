<?php

namespace English\Http\Controllers\API\Test;

use English\Http\Repositories\CrazyRepository;
use English\Http\Resources\MasterResource;
use English\Http\Services\CrazyTestService;
use English\Models\CrazyListenHistory;
use Illuminate\Http\Request;

/**
 * Class CrazyTestAPIController
 * @package English\Http\Controllers\API\Test
 */
class CrazyTestAPIController
{
    /**
     * @var CrazyRepository
     */
    /**
     * @var CrazyRepository|CrazyTestService
     */
    private $repository, $service;

    /**
     * CrazyTestAPIController constructor.
     * @param CrazyRepository $repository
     * @param CrazyTestService $service
     */
    public function __construct(CrazyRepository $repository, CrazyTestService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return MasterResource
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $input['orderBy'] = ['id' => 'ASC'];
        $questions = $this->repository->myPaginate($input);
        return new MasterResource($questions);
    }

    /**
     * @param $id
     * @return MasterResource
     */
    public function reading($id)
    {
        $data = $this->service->reading($id);
        return new MasterResource($data);
    }

    /**
     * @param $id
     * @return MasterResource
     */
    public function read($id)
    {
        $sentences = request('sentences');
        $meanings = request('meanings');
        $data = $this->service->read($id, $sentences, $meanings);
        return new MasterResource($data);
    }

    /**
     * @param $id
     * @return MasterResource
     */
    public function writing($id)
    {
        $data = $this->service->writing($id);
        return new MasterResource($data);
    }

    /**
     * @param $id
     * @return MasterResource
     */
    public function written($id)
    {
        logger(\request()->all());
        $sentences = request('sentences');
        $data = $this->service->written($id, $sentences);

        return new MasterResource($data);
    }

    public function listening($id)
    {
        $user_id = auth('api')->id();

        if($user_id) {
            $crazy_id = $id;
            $history = CrazyListenHistory::firstOrCreate(compact('user_id', 'crazy_id'));
            $history->increment('count', 1);
            $history->save();
        }

        $data = $this->repository->with('details:id,crazy_id,sentence,meaning,time')->find($id);
        return new MasterResource($data);
    }

    public function listen($id)
    {
        $sentences = request('sentences');
        $meanings = request('meanings');
        $data = $this->service->listen($id, $sentences, $meanings);
        return new MasterResource($data);
    }

    public function speak($id)
    {
        try {
            $data = $this->service->speak($id);
            return response()->json($data);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 500);
        }
    }

//    public function speaked($id)
//    {
//
//    }
}
