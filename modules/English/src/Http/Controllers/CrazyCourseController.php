<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 10/4/18
 * Time: 8:26 PM
 */

namespace English\Http\Controllers;

use English\Http\Repositories\CrazyCourseRepository;

class CrazyCourseController
{

    private $repository;

    public function __construct(CrazyCourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getList($id)
    {
        $data = $this->repository->getList($id);

        if (empty($data)) {
            session()->flash('error', 'not found');
            return back();
        }

        return view('en::english.crazy-course.list', $data);
    }
}