<?php


namespace English\Http\Controllers\API;


use App\Http\Controllers\Controller;
use English\Http\Repositories\CrazyListenHistoryRepository;
use English\Http\Repositories\CrazyReadHistoryRepository;
use English\Http\Repositories\CrazySpeakHistoryRepository;
use English\Http\Repositories\CrazyWriteHistoryRepository;

class HistoryAPIController extends Controller
{
    protected $crazyWriteHistoryRepository;
    protected $crazyListenHistoryRepository;
    protected $crazySpeakHistoryRepository;
    protected $crazyReadHistoryRepository;


    public function __construct(
        CrazyWriteHistoryRepository $crazyWriteHistoryRepository,
        CrazyListenHistoryRepository $crazyListenHistoryRepository,
        CrazySpeakHistoryRepository $crazySpeakHistoryRepository,
        CrazyReadHistoryRepository $crazyReadHistoryRepository
    )
    {
        $this->crazyListenHistoryRepository = $crazyListenHistoryRepository;
        $this->crazyWriteHistoryRepository = $crazyWriteHistoryRepository;
        $this->crazySpeakHistoryRepository = $crazySpeakHistoryRepository;
        $this->crazyReadHistoryRepository = $crazyReadHistoryRepository;
    }

    public function index()
    {
        $user_id = auth('api')->id();
        $filter = compact('user_id');

        try {
            $listen = $this->crazyListenHistoryRepository->filterValue($filter, 'count') ?? 0;
            $write = $this->crazyWriteHistoryRepository->filterCount($filter);
            $speak = $this->crazySpeakHistoryRepository->filterCount($filter);
            $read = $this->crazyReadHistoryRepository->filterCount($filter);

            $data = compact('listen', 'write', 'read', 'speak');

            return response()->json(compact('data'));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
