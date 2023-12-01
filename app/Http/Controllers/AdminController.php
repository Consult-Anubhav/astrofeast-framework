<?php

namespace App\Http\Controllers;

use App\Models\Integration;
use App\Models\Module;
use App\Models\ModulePermission;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    // Index API Functions
    public function indexSettings()
    {
        return view('settings.dashboard_settings');
    }

    public function indexStore()
    {
        return view('settings.store');
    }

    public function indexRegions()
    {
        return view('settings.addresses');
    }

    public function indexCurrencies()
    {
        return view('settings.currencies');
    }

    public function indexRoles()
    {
        return view('settings.roles');
    }

    public function indexStaff()
    {
        return view('settings.staff');
    }

    public function indexTaxes()
    {
        return view('settings.taxes');
    }

    public function indexIntegrations()
    {
        return view('settings.integrations');
    }

    public function indexFileManager()
    {
        return view('settings.filemanager');
    }

    public function indexPermissions()
    {
        return view('settings.permissions');
    }

    public function indexShippings()
    {
        return view('settings.shippings');
    }

    // List API Functions
    public function getListStaff()
    {
        return User::getStaffList();
    }

    public function getListRoles()
    {
        return Role::getRolesList();
    }

    public function getListModules()
    {
        return Module::all();
    }

    public function getListRolePermissions()
    {
        return ModulePermission::getRoleModulePermissionList();
    }

    public function getAllIntegrations()
    {
        $data['data'] = Integration::getData()->groupBy('integration_name');
        $data['tokens'] = Integration::getAccessTokens();

        return $data;
    }

    public function getAllRegions(Request $request)
    {
        $filters['page_size'] = $request->page_size ?? 25;
        $data['data'] = Region::getFilteredCountries($filters);

        $data['dropdowns'] = [];

        return $data;
    }

    public function getAllProvinces(Request $request)
    {
        $filters['page_size'] = $request->page_size ?? 25;
        $data['data'] = Region::getFilteredProvinces($filters);

        $data['dropdowns'] = [];

        return $data;
    }

    public function getAllAddresses(Request $request)
    {
        $filters['page_size'] = $request->page_size ?? 25;
        $data['data'] = Region::getFilteredAddresses($filters);

        $data['dropdowns'] = [];

        return $data;
    }

    // CRUD API Functions
    public function actionStaff(Request $request)
    {
        $data = $request->get('data');
        $for_what = $request->get('for_what');

        if ($for_what == 'update') {
            $validator = \Validator::make($data, [
                'email' => 'required|email',
                'name' => 'required|min:4'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'status' => 400
                ], 400);
            }

            if (isset($data['id'])) {
                $staff = User::where('id', '=', $data['id'])->first();
                $staff->is_active = $data['is_active'];
            } else {
                $staff = new User();
                $staff->password = bcrypt('Astrofeast@2023');
                $staff->is_active = 0;
            }
            $staff->name = $data['name'];
            $staff->email = $data['email'];
            $staff->save();

            // get and store old user role
            $new_user_roles = [];
            $old_user_roles = UserRole::select('role_id')
                ->where('user_id', '=', $staff->id)
                ->get();

            // update or insert user role
            foreach ($data['roles_arr'] as $role) {
                if (isset($role['id'])) {
                    $new_user_roles[] = $role['id'];
                    $user_role = UserRole::where('user_id', '=', $staff->id)
                        ->where('role_id', '=', intval($role['id']))
                        ->first();
                    if (!$user_role) {
                        $user_role = new UserRole();
                        $user_role->role_id = intval($role['id']);
                        $user_role->user_id = $staff->id;
                        $user_role->save();
                    }
                }
            }

            // delete user role
            if (count($old_user_roles) > 0) {
                $old_user_roles_arr = $old_user_roles->pluck('role_id');
                foreach ($old_user_roles_arr as $role) {
                    if (!in_array($role, $new_user_roles)) {
                        UserRole::where('user_id', '=', $staff->id)
                            ->where('role_id', '=', $role)
                            ->delete();
                    }
                }
            }

            return $staff;

        } elseif ($for_what == 'delete') {
            User::where('id', '=', $data['id'])->delete();

            return response()->json([
                'messages' => [$data['name'] . ' is deleted successfully.'],
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'messages' => ["Missing or invalid inputs provided."],
                'status' => 200
            ], 200);
        }
    }

    public function actionRoles(Request $request)
    {
        $data = $request->get('data');
        $for_what = $request->get('for_what');

        if ($for_what == 'update') {
            $validator = \Validator::make($data, [
                'title' => 'required|min:4',
                'level' => 'required|numeric|gt:0'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'status' => 400
                ], 400);
            }

            if (isset($data['id'])) {
                $role = Role::where('id', '=', $data['id'])->first();
                $role->is_active = $data['is_active'];
            } else {
                $role = new Role();
                $role->is_active = 0;
            }

            $role->title = $data['title'];
            $role->level = $data['level'];
            $role->save();

            return $role;

        } elseif ($for_what == 'delete') {
            Role::where('id', '=', $data['id'])->delete();

            return response()->json([
                'messages' => [$data['title'] . ' is deleted successfully.'],
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'messages' => ["Missing or invalid inputs provided."],
                'status' => 200
            ], 200);
        }
    }

    public function actionRolePermissions(Request $request)
    {
        $data = $request->get('data');
        $for_what = $request->get('for_what');

        if ($for_what == 'update') {
            $validator = \Validator::make($data, [
                'id' => ['required', Rule::exists('roles')->where(function ($query) use ($data) {
                    $query->where('id', $data['id']);
                })]
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'status' => 400
                ], 400);
            }

            // get and store old user role
            $new_permissions = [];
            $old_permissions = ModulePermission::select('module_id')
                ->where('role_id', '=', $data['id'])
                ->get();

            // update or insert user role
            foreach ($data['permissions_arr'] as $module) {
                if (isset($module['id'])) {
                    $new_permissions[] = $module['id'];
                    $permissions = ModulePermission::where('role_id', '=', $data['id'])
                        ->where('module_id', '=', $module['id'])
                        ->first();
                    if (!$permissions) {
                        $permissions = new ModulePermission();
                        $permissions->module_id = intval($module['id']);
                        $permissions->role_id = $data['id'];
                    }
                    $permissions->read = $module['read'] ?? 0;
                    $permissions->write = $module['write'] ?? 0;
                    $permissions->delete = $module['delete'] ?? 0;
                    $permissions->save();
                    // update redis ACL
                    Role::redisSetRolesPermissions($permissions->role_id);
                    Role::redisUpdateRoleUsersPermissions($permissions->role_id);
                }
            }

            // delete user role
            if (count($old_permissions) > 0) {
                $old_permissions_arr = $old_permissions->pluck('module_id');
                foreach ($old_permissions_arr as $module) {
                    if (!in_array($module, $new_permissions)) {
                        ModulePermission::where('role_id', '=', $data['id'])
                            ->where('module_id', '=', $module)
                            ->delete();
                    }
                }
            }

            return $data;

        } else {
            return response()->json([
                'messages' => ["Missing or invalid inputs provided."],
                'status' => 200
            ], 200);
        }
    }

    public static function actionGenerateToken(Request $request)
    {
        $for_what = $request->for_what;
        $data = [];

        if ($for_what === 'new_token') {
            $token_data = $request->get('data');

            $validator = \Validator::make($token_data, [
                'name' => 'required|unique:personal_access_tokens',
                'expiry_date' => 'required|date_format:Y-m-d'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all(),
                    'status' => 400
                ], 400);
            }

            $token = $request->user()->createToken($token_data['name']);
            $data['new_token'] = [
                'name' => $token->accessToken->name,
                'token' => $token->plainTextToken,
                'data' => $token
            ];
            Integration::updateToken($token->accessToken->id, $token_data);
        } elseif ($for_what === 'delete') {
            $token_id = $request->get('data');
            Integration::deleteToken($token_id);
        }
        $data['tokens'] = Integration::getAccessTokens();
        return $data;
    }

    public function actionIntegrations(Request $request)
    {
        $data = $request->data;
        $for_what = $request->for_what;

        if ($for_what === 'update_all') {
            foreach ($data as $integration => $variables) {
                foreach ($variables as $row) {
                    Integration::where('integration_name', $integration)
                        ->where('code', $row['code'])
                        ->update([
                            'integration_name' => $row['integration_name'],
                            'code' => $row['code'],
                            'value' => $row['value'],
                            'sort_order' => $row['sort_order'],
                            'test' => $row['test'],
                        ]);
                }
            }
        }

        if ($for_what === 'update_integration') {
            $old_ids = Integration::pluck('id')->toArray();
            $new_ids = Arr::pluck($data['fields'], 'id');

            foreach ($old_ids as $id) {
                if (!in_array($id, $new_ids)) {
                    Integration::where('id', '=', $id)->delete();
                }
            }

            foreach ($data['fields'] as $field) {
                if (isset($field['id'])) {
                    Integration::updateOrCreate([
                        'id' => $field['id']
                    ], [
                        'code' => $field['code'],
                        'integration_name' => $data['integration_name'],
                        'value' => isset($field['value']) ? $field['value'] : '',
                        'sort_order' => isset($field['sort_order']) ? $field['sort_order'] : 0,
                        'test' => isset($field['test']) ? $field['test'] : 0,
                    ]);
                } else {
                    Integration::updateOrCreate([
                        'integration_name' => $data['integration_name'],
                        'code' => $field['code']
                    ], [
                        'value' => isset($field['value']) ? $field['value'] : '',
                        'sort_order' => isset($field['sort_order']) ? $field['sort_order'] : 0,
                        'test' => isset($field['test']) ? $field['test'] : 0,
                    ]);
                }
            }
        }

        return $this->getAllIntegrations();
    }

    // common APIs
}
