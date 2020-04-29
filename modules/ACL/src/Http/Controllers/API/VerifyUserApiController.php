<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 9/11/18
 * Time: 9:54 AM
 */

namespace ACL\Http\Controllers\API;

use App\Http\Controllers\Controller;
use ACL\Http\Requests\VerifyUserCreateRequest;
use ACL\Http\Requests\VerifyUserUpdateRequest;
use ACL\Http\Resources\VerifyUserResource;
use ACL\Http\Repositories\VerifyUserRepository;
use Illuminate\Http\Request;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

/**
 * @group ACL
 *
 * APIs for acl
 */
class VerifyUserApiController  extends Controller
{
    use ControllersTrait;
    /**
     * @var VerifyUserRepository
     */
    private $repository;

    /**
     * VerifyUserApiController constructor.
     * @param VerifyUserRepository $repository
     */
    public function __construct(VerifyUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return VerifyUserResource
     */
    public function index(Request $request)
    {
        $input = $request->all();
        $data = $this->repository->myPaginate($input);
        return new VerifyUserResource($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('acl::verify-user.create');
    }

    /**
     * @param VerifyUserCreateRequest $request
     * @return VerifyUserResource
     */
    public function store(VerifyUserCreateRequest $request)
    {
        $input = $request->all();
        $verifyUser = $this->repository->store($input);
        return new VerifyUserResource($verifyUser);
    }

    /**
     * @param $id
     * @return VerifyUserResource
     */
    public function show($id)
    {
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            return new VerifyUserResource([$verifyUser]);
        }
        return new VerifyUserResource($verifyUser);
    }

    /**
     * @param $id
     * @return VerifyUserResource
     */
    public function edit($id)
    {
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            return new VerifyUserResource([$verifyUser]);
        }
        return new VerifyUserResource($verifyUser);
    }

    /**
     * @param VerifyUserUpdateRequest $request
     * @param $id
     * @return VerifyUserResource
     */
    public function update(VerifyUserUpdateRequest $request, $id)
    {
        $input = $request->all();
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            return new VerifyUserResource([$verifyUser]);
        }
        $data = $this->repository->change($input, $verifyUser);
        return new VerifyUserResource($data);
    }

    /**
     * @param $id
     * @return VerifyUserResource
     */
    public function destroy($id)
    {
        $verifyUser = $this->repository->find($id);
        if (empty($verifyUser)) {
            return new VerifyUserResource($verifyUser);
        }
        $data = $this->repository->delete($id);
        return new VerifyUserResource([$data]);
    }
}
