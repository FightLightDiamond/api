<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 5/10/17
 * Time: 8:20 AM
 */

namespace ACL\Http\ViewComposers;

use ACL\Http\Repositories\RoleRepository;
use Illuminate\View\View;

class RoleComposer
{
    private $repository;
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }
    public function compose(View $view)
    {
        $list = $this->repository->makeModel()->pluck('display_name', 'id');
        $view->with(['roleCompose' => $list]);
    }
}