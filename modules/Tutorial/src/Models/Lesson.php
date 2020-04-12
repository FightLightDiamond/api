<?php

namespace Tutorial\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Lesson extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'lessons';
    public $fillable = ['title', 'intro', 'content', 'section_id', 'views', 'last_view', 'created_by', 'updated_by', 'is_active', 'no'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/lessons'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

