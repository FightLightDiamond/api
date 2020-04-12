<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\LessonTest;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LessonTestRepositoryEloquent extends BaseRepository implements LessonTestRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name'subject_id'
     *
     * @return string
     */
    public function model()
    {
        return LessonTest::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->filter($input)
            ->with(['lesson:id,title', 'creator:id,email', 'updater:id,email'])
            ->paginate($input['per_page']);
    }

    public function store($input)
    {
        $input['created_by'] = auth()->id();
        $input['updated_by'] = auth()->id();
        $input = $this->standardized($input, $this->makeModel());
        $this->create($input);
    }

    public function edit($id)
    {
        $lessonTest = $this
            ->with(['lesson:id,section_id', 'lesson.section:id,tutorial_id', 'lesson.section.tutorial:id'])
            ->find($id);
        if(empty($lessonTest)) {
            return $lessonTest;
        }
        $section_id = 0;
        $tutorial_id = 0;
        $sectionList = [];
        $lessonList = [];
        if(isset($lessonTest->lesson->section))
        {
            $section = $lessonTest->lesson->section;
            $section_id = $section->id;
            $lessonList = $section->lessons()->pluck('title', 'id')->toArray();
            if($section->tutorial)
            {
                $tutorial_id = $section->tutorial->id;
                $sectionList = $section->tutorial->sections()->pluck('name', 'id')->toArray();
            }
        }
        $replies = [1 => 'A', 2 => 'B', 3=> 'C', 4=> 'D'];
        return compact('lessonTest', 'lessonList', 'sectionList', 'tutorial_id', 'section_id', 'replies');
    }

    public function change($input, $data)
    {
        $input['updated_by'] = auth()->id();
        $input = $this->standardized($input, $data);
        $this->update($input, $data->id);
    }

    private function standardized($input, $data)
    {
        $input = $data->uploads($input);
        return $data->checkbox($input);
    }

    public function destroy($data)
    {
        $this->delete($data->id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
