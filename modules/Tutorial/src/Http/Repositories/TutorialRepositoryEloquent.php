<?php

namespace Tutorial\Http\Repositories;


use Illuminate\Support\Facades\DB;
use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\Section;
use Tutorial\Models\Tutorial;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TutorialRepositoryEloquent extends BaseRepository implements TutorialRepository
{
    use RepositoriesTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tutorial::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->with(['sections:id,name', 'creator:id,email', 'updater:id,email'])
            ->filter($input)
            ->paginate($input['per_page']);

    }

    public function store($input)
    {
        $input = $this->standardized($input, $this->makeModel());
        $model = $this->create($input);
        if (isset($input['section_names'])) {
            $data = [];
            $now = now();
            foreach ($input['section_names'] as $value) {
                array_push($data, ['name' => $value, 'tutorial_id' => $model->id, CREATED_AT_COL => $now, UPDATED_AT_COL => $now]);
            }
            DB::table('sections')->insert($data);
        }
        return $model;
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $data);
        if(isset($input['section_ids'])) {
            foreach ($input['section_ids'] as $k => $section_id)
            {
                if($section_id == 0) {
                    $lesson = [
                        'tutorial_id' => $data->id,
                        'no' => $k,
                        'name' => $input['section_names'][$k],
                        'create_by' => auth()->id()
                    ];
                    app(Section::class)->create($lesson);
                } else {
                    DB::table(SECTIONS_TB)->where('id', $section_id)->update(['no' => $k, 'name' => $input['section_names'][$k]]);
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
        $tutorial = $this->withCount('sections')->find($id);
        if (empty($tutorial)) {
            session()->flash('error', 'Tutorial not found ');
        } elseif ($tutorial->sections_count !== 0) {
            session()->flash('error', 'Can\'t destroy, please delete all it\'section');
        } else {
            session()->flash('success', 'delete success');
            $this->delete($id);
        }
        return $tutorial;
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
