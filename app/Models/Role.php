<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'title',
        'level',
        'is_active',
    ];

    public static function getRolesList()
    {
        return Role::get();
    }

    public static function redisSetUserRolesPermissions($user_id = null, $overwrite = null)
    {
        if (!Redis::exists('acl:user:' . $user_id) || $overwrite != null) {
            $permissions = [];
            $user_roles_ids = [];
            $result = UserRole::where('user_id', $user_id)->get();
            if ($result != null)
                $user_roles_ids = $result->pluck('role_id')->toArray();
            foreach ($user_roles_ids as $role_id) {
                if (!Redis::exists('acl:role:' . $role_id))
                    self::redisSetRolesPermissions($role_id);
                $temp_permissions = Redis::hgetall('acl:role:' . $role_id);
                $permissions = array_merge($permissions, $temp_permissions);
            }
            Redis::command('hmset', ['acl:user:' . $user_id, $permissions]);
        }
        Redis::expire('acl:user:' . $user_id, 60*120);
    }

    public static function redisSetRolesPermissions($role_id = null)
    {
        $query = ModulePermission::leftjoin('modules', 'modules.id', '=', 'module_permissions.module_id');
        if ($role_id != null)
            $query->where('role_id', $role_id);
        $permissions = $query->get();
        $acl = [];
        foreach ($permissions as $per) {
            $acl[$per->slug . '-read'] = $per->read == 1 ? 1 : 0;
            $acl[$per->slug . '-write'] = $per->write == 1 ? 1 : 0;
            $acl[$per->slug . '-delete'] = $per->delete == 1 ? 1 : 0;
        }
        Redis::command('hmset', ['acl:role:' . $role_id, $acl]);
    }

    public static function redisUpdateRoleUsersPermissions($role_id = null)
    {
        $result = UserRole::where('role_id', $role_id)->get();
        foreach ($result as $row) {
            if (Redis::exists('acl:user:' . $row->user_id)) {
                self::redisSetUserRolesPermissions($row->user_id, 'overwrite');
            }
        }
    }
}
