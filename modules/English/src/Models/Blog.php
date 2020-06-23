<?php

namespace English\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Blog extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'blogs';
    public $fillable = ['title', 'image', 'intro', 'content', 'created_by', 'updated_by'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/blogs'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                    
            ]
        ]
    ];
}

