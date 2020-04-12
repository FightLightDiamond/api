<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 6/14/19
 * Time: 3:42 PM
 */

namespace Tutorial\Http\Fillters;


use Tutorial\Models\Lesson;

class LessonFilter
{
    private $fillable, $model;

    public function __construct()
    {
        $this->model = new Lesson();
        $this->fillable = $this->model->fillable;
    }

    public function scopeTitle($query, $title)
    {
        if (isset($input['title'])) {
            $query->where('title', 'LIKE', '%' . $title . '%');
        }
    }

    public function scopeFilter($query, $params)
    {
        foreach ($params as $field => $value) {
//            $method = 'filter' . Str::studly($field);

            if ($value === '') {
                continue;
            }

            if (method_exists($this, $field)) {
                $this->{$field}($value);
                continue;
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            if (in_array($field, $this->filterable)) {
                $query->where($this->table . '.' . $field, $value);
                continue;
            }
        }

        return $query;
    }
}
