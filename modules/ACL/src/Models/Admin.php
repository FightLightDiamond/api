<?php

namespace ACL\Models;

use Illuminate\Notifications\Notifiable;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    use TransformableTrait;
    use ModelsTrait;
    use SoftDeletes;

    public $table = 'admins';
    public $fillable = ['name', 'email', 'password', 'remember_token'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/admins'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

