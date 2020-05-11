<?php

namespace ETest\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Question extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'questions';
    public $fillable = ['type', 'question', 'answer', 'status', 'time', 'level', 'created_by', 'updated_by'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/questions'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

