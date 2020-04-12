<?php

namespace English\Models;

use Illuminate\Database\Eloquent\Model;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class FillInTheBlank extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'fill_in_the_blanks';
    public $fillable = ['question', 'a', 'b', 'c', 'd', 'answer', 'is_active'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/fill_in_the_blanks'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

