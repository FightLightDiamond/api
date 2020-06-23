<?php

namespace ETest\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class QuestionTest extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'question_tests';
    public $fillable = ['question_id', 'test_id'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/question_tests'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

