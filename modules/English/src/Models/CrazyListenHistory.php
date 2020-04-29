<?php

namespace English\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyListenHistory extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_listen_histories';
    public $fillable = ['user_id', 'crazy_id', 'count'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/crazy_listen_histories'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

