<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/11/18
 * Time: 9:54 AM
 */

namespace IO\Http\Controllers\API;

use App\Http\Controllers\Controller;
use IO\Http\Requests\MessageCreateRequest;
use IO\Http\Requests\MessageUpdateRequest;
use IO\Http\Resources\MessageResource;
use IO\Http\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class MessageAPIController  extends Controller
{
    use ControllersTrait;
    private $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $input = $request->all();
        $data = $this->repository->myPaginate($input);
        return new MessageResource($data);
    }

    public function create()
    {
        return view('io::message.create');
    }

    public function store(MessageCreateRequest $request)
    {
        $input = $request->all();
        $message = $this->repository->store($input);
        return new MessageResource($message);
    }

    public function show($id)
    {
        $message = $this->repository->find($id);

        if (empty($message)) {
            return new MessageResource([$message]);
        }

        return new MessageResource($message);
    }

    public function edit($id)
    {
        $message = $this->repository->find($id);

        if (empty($message)) {
            return new MessageResource([$message]);
        }

        return new MessageResource($message);
    }

    public function update(MessageUpdateRequest $request, $id)
    {
        $input = $request->all();
        $message = $this->repository->find($id);
        if (empty($message)) {
            return new MessageResource([$message]);
        }
        $data = $this->repository->change($input, $message);

        return new MessageResource($data);
    }

    public function destroy($id)
    {
        $message = $this->repository->find($id);
        if (empty($message)) {
            return new MessageResource($message);
        }
        $data = $this->repository->delete($id);

        return new MessageResource([$data]);
    }
}
