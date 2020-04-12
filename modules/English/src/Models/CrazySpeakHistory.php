<?php

namespace English\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CrazySpeakHistory extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'crazy_speak_histories';
    public $fillable = ['user_id', 'crazy_id', 'score', 'audio'];

    public $fileUpload = ['audio' => 0];
    protected $pathUpload = ['audio' => '/audios/crazy_speak_histories'];

    public function crazy()
    {
        return $this->belongsTo(Crazy::class, 'crazy_id', 'id');
    }

    public function getAudioAttribute($value)
    {
        return url('storage' . $value);
    }

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

