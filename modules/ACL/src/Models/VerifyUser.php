<?php

namespace ACL\Models;

use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VerifyUser extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;
//    use SoftDeletes;

    public $table = 'verify_users';
    public $fillable = ['user_id', 'code', 'email', 'phone', 'otp_verified', 'google_authentication'];

    public $fileUpload = ['image' => 1];
    protected $pathUpload = ['image' => '/images/verify_users'];
    protected $thumbImage = [
        'image' => [
            '/thumbs/' => [

            ]
        ]
    ];
}

