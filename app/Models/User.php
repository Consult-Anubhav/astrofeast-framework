<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',

        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime:d-M-Y h:i A'
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    public static function getStaffList($staff_id = null)
    {
        $query = User::leftjoin('user_roles', 'user_roles.user_id', '=', 'users.id')
            ->leftjoin('roles', 'roles.id', '=', 'user_roles.role_id')
            ->select(
                'users.*',
                DB::raw("GROUP_CONCAT(roles.title ORDER BY roles.title SEPARATOR ', " . Chr(13).Chr(10) . "') as roles"),
                DB::raw("GROUP_CONCAT(CONCAT(roles.id,':',roles.title) ORDER BY roles.id SEPARATOR ',') as roles_arr")
            )
            ->groupBy('users.id');

        if ($staff_id == null)
            $results = $query->get();
        else
            $results = $query->where('users.id', '=', $staff_id)->first();

        foreach ($results as $row) {
            $arr = [];
            $role_ids = array_filter(explode(',', $row->roles_arr));
            foreach($role_ids as $role_row) {
                $role = array_filter(explode(':', $role_row));
                $arr[] = [
                    'id' => intval($role[0]),
                    'title' => $role[1]
                ];
            }
            $row->roles_arr = $arr;
        }

        return $results;
    }
}
