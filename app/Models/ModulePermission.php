<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModulePermission extends Model
{
    protected $table = 'module_permissions';

    protected $fillable = [
        'module_id',
        'role_id',
        'read',
        'write',
        'delete',
        'is_active'
    ];

    public static function getRoleModulePermissionList($staff_id = null)
    {
        $query = ModulePermission::leftjoin('modules', 'modules.id', '=', 'module_permissions.module_id')
            ->leftjoin('roles', 'roles.id', '=', 'module_permissions.role_id')
            ->select(
                'roles.*',
                DB::raw("GROUP_CONCAT(
                    CONCAT(modules.title,' (',CONCAT_WS('-',
                        IF(module_permissions.read = 1,'R',null),
                        IF(module_permissions.write = 1,'W',null),
                        IF(module_permissions.delete = 1,'D',null)
                    ),')')
                    ORDER BY modules.title
                    SEPARATOR ', " . Chr(13) . Chr(10) . "'
                ) as permissions"),
                DB::raw("GROUP_CONCAT(
                    CONCAT(
                        modules.id,':',modules.title,':',
                        module_permissions.read,':',module_permissions.write,':',module_permissions.delete
                    )
                    ORDER BY modules.title
                    SEPARATOR ','
                ) as permissions_arr")
            )
            ->groupBy('roles.id');

        if ($staff_id == null)
            $results = $query->get();
        else
            $results = $query->leftjoin('user_roles', 'user_roles.role_id', '=', 'module_permissions.role_id')
                ->where('user_roles.user_id', '=', $staff_id)
                ->get();

        foreach ($results as $row) {
            $arr = [];
            $permission_ids = explode(',', $row->permissions_arr);
            foreach ($permission_ids as $permission_row) {
                $permission = explode(':', $permission_row);
                $arr[] = [
                    'id' => intval($permission[0]),
                    'title' => $permission[1],
                    'read' => intval($permission[2]),
                    'write' => intval($permission[3]),
                    'delete' => intval($permission[4])
                ];
            }
            $row->permissions_arr = $arr;
        }

        return $results;
    }
}
