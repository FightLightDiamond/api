<?php

namespace ACL\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Cuongpm\Modularization\MultiInheritance\ControllersTrait;

class Role extends Model
{
    use ControllersTrait;
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    protected $fillable = [
        'name',
        'display_name',
        'is_active',
        'label',
        'permissions'
    ];

    public function scopeFilter($query, $input)
    {
        if(isset($input['is_active']) && trim($input['is_active']) !== '')
        {
            $query->where('is_active',  trim($input['is_active']) );
        }
        if(isset($input['name']) && trim($input['name']) !== '')
        {
            $query->where('name', 'LIKE', '%' . trim($input['name']) . '%');
        }
        if(isset($input['display_name']) && trim($input['display_name']) !== '')
        {
            $query->where('display_name', 'LIKE', '%' . trim($input['display_name']) . '%');
        }
        return $query;
    }

    public function permission() {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }

    public function user() {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
