<?php

namespace Tutorial\Http\Repositories;

use Illuminate\Support\Facades\DB;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\Lesson;
use Tutorial\Models\Section;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SectionRepositoryEloquent extends BaseRepository implements SectionRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Section::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->filter($input)
            ->paginate($input['per_page']);

    }

    public function store($input)
    {
        $input = $this->standardized($input, $this->makeModel());
        return $this->create($input);
    }

    public function edit($id) {
        $section = $this->find($id);
        if(empty($section))
        {
            return $section;
        }
        $tutorial = $section->tutorial;
        $lessons = $section->lessons()
            ->orderBy('no', 'ASC')
            ->pluck('title', 'id')->toArray();
        return compact('section', 'lessons', 'tutorial');
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $data);
        if(isset($input['lesson_ids']))
        {
            foreach ($input['lesson_ids'] as $k => $lesson_id)
            {
                if($lesson_id == 0) {
                    $lesson = [
                        'section_id' => $data->id,
                        'no' => $k + 1,
                        'title' => $input['lesson_names'][$k],
                        'created_by' => auth()->id()
                    ];
                    app(Lesson::class)->create($lesson);
                } else {
                    DB::table(LESSONS_TB)->where('id', $lesson_id)->update(['no' => $k + 1, 'title' => $input['lesson_names'][$k]]);
                }
            }
        }
        return $this->update($input, $data->id);
    }


    private function standardized($input, $data)
    {
        $input = $data->uploads($input);
        return $data->checkbox($input);
    }

    public function destroy($id)
    {
        $section = $this->withCount('lessons')
            ->find($id, ['id', 'lesson_id']);
        if(empty($section)) {
            session()->flash('error', 'Not Found');
            return false;
        }
        if($section->lessons_count > 0)
        {
            session()->flash('error', 'Have lessons, please remove before');
            return false;
        }
        session()->flash('success', 'Delete success');
        return $this->delete($id);
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
