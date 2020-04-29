<?php

namespace English\Models;


use App\User;
use Cuongpm\Modularization\MultiInheritance\ModelsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Remind extends Model implements Transformable
{
    use TransformableTrait;
    use ModelsTrait;

    public $table = 'reminds';
    public $fillable = ['user_id', 'hour', 'minute', 'job'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

