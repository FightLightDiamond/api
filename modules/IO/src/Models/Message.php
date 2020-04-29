<?php

namespace IO\Models;

use App\User;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Message extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;
//    use SoftDeletes;

    public $table = 'messages';
    public $fillable = ['from', 'to', 'content'];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to');
    }

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function toContact()
    {
        return $this->hasOne(User::class, 'id', 'to');
    }

}

