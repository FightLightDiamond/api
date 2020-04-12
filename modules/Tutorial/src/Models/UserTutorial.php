<?php

namespace Tutorial\Models;


use App\User;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserTutorial extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'user_tutorials';
    public $fillable = ['user_id', 'tutorial_id'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/user_tutorials'];
    public $timestamps = false;

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class, 'tutorial_id');
    }
}

