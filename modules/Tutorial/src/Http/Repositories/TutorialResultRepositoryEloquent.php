<?php

namespace Tutorial\Http\Repositories;


use Cuongpm\Modularization\MultiInheritance\RepositoriesTrait;

use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Tutorial\Models\Section;
use Tutorial\Models\TutorialResult;

/**
 * Class NewsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TutorialResultRepositoryEloquent extends BaseRepository implements TutorialResultRepository
{
    use RepositoriesTrait;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TutorialResult::class;
    }

    public function myPaginate($input)
    {
        isset($input['per_page']) ?: $input['per_page'] = 10;
        return $this->makeModel()
            ->with(['creator:id,email', 'tutorial:id,name'])
            ->filter($input)
            ->paginate($input['per_page']);
    }

    public function store($input)
    {
        $input = $this->standardized($input, $this->makeModel());
        $this->create($input);
    }

    public function change($input, $data)
    {
        $input = $this->standardized($input, $data);
        $this->update($input, $data->id);
    }


    private function standardized($input, $data)
    {
        if(isset($input['section_names']))
        {
            $sectionIds= [];
            foreach ($input['section_names'] as $name)
            {
                $section = $this->app(Section::class)->firstOrCreate(compact('name'));
                $sectionIds[] = $section->id;
            }
            $data->sections()->sync($sectionIds);
        }
        $input = $data->uploads($input);
        return $data->checkbox($input);
    }

    public function destroy($id)
    {
        $tutorial = $this->withCount('sections')->find($id);

        // TODO: Implement remove() method.
    }

    /**
     * Boot up the repository, ping criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
