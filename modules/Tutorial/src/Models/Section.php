<?php

namespace Tutorial\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Section extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'sections';
    public $fillable = ['name', 'img', 'tutorial_id', 'description', 'is_active'];

    public function scopeFilter($query, $input)
    {
        if (isset($input['name'])) {
            $query->where('name', 'LIKE', '%' . $input['name'] . '%');
        }
        if (isset($input['img'])) {
            $query->where('img', $input['img']);
        }
        if (isset($input['is_active'])) {
            $query->where('is_active', $input['is_active']);
        }
        if (isset($input['tutorial_id'])) {
            $query->where('tutorial_id', $input['tutorial_id']);
        }
        return $query;
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'section_id');
    }

    public $fileUpload = ['img' => 1];
    protected $pathUpload = ['img' => '/images/sections'];
    protected $thumbImage = [
        'img' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

