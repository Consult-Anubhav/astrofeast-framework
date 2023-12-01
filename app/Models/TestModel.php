<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestModel extends Model
{
    public static function getRandomProduct()
    {
        return DB::table('master_product_variants')
            ->orderByRaw("rand()")
            ->limit(1)
            ->first();
    }
}
