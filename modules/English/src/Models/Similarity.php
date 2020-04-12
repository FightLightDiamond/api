<?php

namespace English\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Similarity extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'similarities';
    public $fillable = ['question', 'replacement', 'a', 'b', 'c', 'd', 'answer', 'reason', 'is_active'];

    public function filterQuestion($query, $input)
    {
        $query->where('question', 'LIKE', '%' . $input['question'] . '%');

        return $query;
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/similarities'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

