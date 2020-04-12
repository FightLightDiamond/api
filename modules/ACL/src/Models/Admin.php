<?php

namespace ACL\Models;


use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Admin extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'admins';
    public $fillable = ['name', 'email', 'password', 'remember_token', 'is_active'];
}
