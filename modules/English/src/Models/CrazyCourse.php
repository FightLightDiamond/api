<?php

namespace English\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazyCourse extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_courses';
    public $fillable = ['name', 'img', 'description', 'is_active', 'created_by', 'updated_by'];

    protected $appends = [
        'small_thumb',
        'medium_thumb',
        'large_thumb',
    ];

    public function getImgAttribute($value)
    {
        return url('storage' . $value);
    }

    public function crazies()
    {
        return $this->hasMany(Crazy::class, 'crazy_course_id');
    }

    public function getSmallThumbAttribute($value)
    {
        return $this->getThumbPath('img', [200, 200]);
    }

    public function getMediumThumbAttribute($value)
    {
        return $this->getThumbPath('img', [300, 300]);
    }

    public function getLargeThumbAttribute($value)
    {
        return $this->getThumbPath('img', [400, 400]);
    }

    public function getThumbPath($field, $sizes)
    {
        $img = $this->$field;
        $sizeImage = '_' . implode('_', $sizes) . '.';
        $imgThumbs = $this->str_lreplace('.', $sizeImage, $img);
        return ("{$imgThumbs}");
    }


    function str_lreplace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);

        if ($pos !== false) {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }

        return $subject;
    }

    public $fileUpload = ['img' => 1];
    protected $pathUpload = ['img' => '/images/crazy_courses'];

    protected $thumbImage = [
        'img' => [
            '/thumbs/' => [
                [200, 200], [300, 300], [400, 400]
            ]
        ]
    ];
}

