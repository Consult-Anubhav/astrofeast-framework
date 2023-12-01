<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Konekt\Address\Models\Address;
use Konekt\Address\Models\Country;
use Konekt\Address\Models\Province;

class Region extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'type',
        'name',
        'city',
        'address',
        'address_line_2',
        'postalcode',
        'country_id',
        'province_id'
    ];

    public static function getFilteredCountries($filters)
    {
        $query = Country::query();
        if (isset($filters['query']))
            $query->where(function($q) use ($filters) {
                $q->where('id', 'LIKE', '%'.$filters['query'].'%')
                    ->orWhere('name', 'LIKE', '%'.$filters['query'].'%')
                    ->orWhere('phonecode', 'LIKE', '%'.$filters['query'].'%');
            });
        return $query->paginate($filters['page_size'] ?? 10);
    }

    public static function getFilteredProvinces($filters)
    {
        $query = Province::query();
        if (isset($filters['query']))
            $query->where(function($q) use ($filters) {
                $q->where('code', 'LIKE', '%'.$filters['query'].'%')
                    ->orWhere('name', 'LIKE', '%'.$filters['query'].'%');
            });
        return $query->paginate($filters['page_size'] ?? 10);
    }

    public static function getFilteredAddresses($filters)
    {
        $query = Address::leftJoin('customer_addresses', 'customer_addresses.address_id', '=', 'addresses.id')
                    ->select(
                        'addresses.*',
                        DB::raw("COUNT('customer_addresses.customer_id') as customers")
                    )
                    ->groupBy(
                        'addresses.id',
                        'addresses.type',
                        'addresses.name',
                        'addresses.country_id',
                        'addresses.postalcode',
                        'addresses.city',
                        'addresses.address',
                        'customer_addresses.address_id'
                    );
        if (isset($filters['query']))
            $query->where(function($q) use ($filters) {
                $q->where('code', 'LIKE', '%'.$filters['query'].'%')
                    ->orWhere('name', 'LIKE', '%'.$filters['query'].'%');
            });
        return $query->paginate($filters['page_size'] ?? 10);
    }
}
