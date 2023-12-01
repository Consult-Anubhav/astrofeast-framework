<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Integration extends Model
{
    protected $table = 'integration';

    protected $fillable = [
        'integration_name',
        'code',
        'value',
        'sort_order',
        'test'
    ];

    public static function getCodeValue($integration, $code)
    {
        $row = Integration::where('integration_name', '=', $integration)
            ->where('code', '=', $code)
            ->first();

        if ($row != null)
            return $row->value;
        else
            return $row;
    }

    public static function getData()
    {
        return Integration::orderBy('integration_name', 'ASC')->orderBy('sort_order', 'ASC')->get();
    }

    public static function getAccessTokens()
    {
        return DB::table('personal_access_tokens')
            ->where('tokenable_type', '=', User::class)
            ->select('id', 'name', 'created_at', 'expires_at')
            ->get();
    }

    public static function updateToken($id, $token_data)
    {
        return DB::table('personal_access_tokens')
            ->where('tokenable_type', '=', User::class)
            ->where('id', '=', $id)
            ->update([
                'expires_at' => $token_data['expiry_date']
            ]);
    }

    public static function deleteToken($id)
    {
        return DB::table('personal_access_tokens')
            ->where('tokenable_type', '=', User::class)
            ->where('id', '=', $id)
            ->delete();
    }

    public static function getTestData()
    {
        return Integration::where('test', '=', 1)
            ->orderBy('integration_name', 'ASC')
            ->orderBy('sort_order', 'ASC')
            ->get();
    }
}
