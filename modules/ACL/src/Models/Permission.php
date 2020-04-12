<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 8/3/17
 * Time: 11:39 AM
 */

namespace ACL\Models;

use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use TransformableTrait;

    public $fillable = ['name', 'display_name', 'description', 'is_active', 'module_id', 'access_id'];

    public function scopeFilter($query, $input)
    {
        if(isset($input['module_id']) && trim($input['module_id']) !== '')
        {
            $query->where('module_id', trim($input['module_id']) );
        }
        if(isset($input['access_id']) && trim($input['access_id']) !== '')
        {
            $query->where('access_id', trim($input['access_id']) );
        }
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

    public function scopeOrder($query, $column, $value)
    {
        return $query->orderBy($column, $value);
    }

    public function role() {
        return $this->belongsToMany(Role::class, 'role_permission', 'permission_id', 'role_id');
    }
}
