<?php

namespace Tutorial\Models;

use App\User;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Tutorial extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'tutorials';
    public $fillable = ['name', 'img', 'is_active', 'description'];

    public function filterName($query, $input)
    {
        $query->where('name', 'LIKE', "%" . $input . "%");
        return $query;
    }

//    public function scopeFilter($query, $input)
//    {
//
//        if (isset($input['is_active'])) {
//            $query->where('is_active', $input['is_active']);
//        }
//        return $query;
//    }

    public function sections()
    {
        return $this->hasMany(Section::class, 'tutorial_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tutorials', 'tutorial_id', 'user_id');
    }

    public function userTutorials()
    {
        return $this->hasMany(UserTutorial::class, 'tutorial_id');
    }

    public $fileUpload = ['img' => 1];
    protected $pathUpload = ['img' => '/images/tutorials'];
    protected $thumbImage = [
        'img' => [
            '/thumbs/' => [
                [200, 150], [400, 300]
            ]
        ]
    ];
    protected $checkbox = ['is_active'];
}

