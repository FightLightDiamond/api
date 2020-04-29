<?php

namespace ACL\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'users';
    public $fillable = ['first_name', 'last_name', 'code', 'email', 'phone_number', 'sex', 'password', 'birthday', 'address', 'avatar', 'remember_token', 'is_active', 'last_login', 'last_logout', 'slack_webhook_url', 'coin', 'locale', 'group_id'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/users'];

    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

