<?php

namespace GCard\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Hero extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'heroes';
    public $fillable = ['name', 'nickname', 'role', 'sayings', 'class_id', 'image', 'element_id', 'publish_time', 'status'];

    public function getImgAttribute($value)
    {
        return url('storage' . $value);
    }

    public function getSmallThumbAttribute($value)
    {
        return $this->getThumbPath('image', [200, 200]);
    }

    public function getMediumThumbAttribute($value)
    {
        return $this->getThumbPath('image', [300, 300]);
    }

    public function getLargeThumbAttribute($value)
    {
        return $this->getThumbPath('image', [400, 400]);
    }

    public function getThumbPath($field, $sizes)
    {
        $image = $this->$field;
        $sizeImage = '_' . implode('_', $sizes) . '.';
        $imageThumbs = $this->str_lreplace('.', $sizeImage, $image);
        return ("{$imageThumbs}");
    }
    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/heroes'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [
                [200, null], [300, null], [400, null]
            ]
        ]
    ];
}

