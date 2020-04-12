<?php

namespace English\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pronunciation extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'pronunciations';
    public $fillable = ['a', 'b', 'c', 'd',
        'pronunciation_a', 'pronunciation_b',  'pronunciation_c',  'pronunciation_d',
        'answer', 'is_active'];

    public function filterQuestion($query, $input)
    {

        $query->where('a', $input['question'])
            ->orWhere('b', $input['question'])
            ->orWhere('c', $input['question'])
            ->orWhere('d', $input['question']);

        return $query;
    }

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/pronunciations'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
}

