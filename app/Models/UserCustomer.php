<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class UserCustomer extends Authenticatable implements AuthenticatableContract
{
    protected $table = 'customers';

    protected $guarded = ['id'];

    protected $fillable = [
        'firstname',
        'lastname',
        'type',
        'phone',
        'company_name',
        'tax_nr',
        'registration_nr',
        'currency',
        'timezone',
        'is_active',
        'ltv',
        'last_purchase_at',
//        'email_verified_at',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
//        'last_purchase_at' => 'datetime',
        'email_verified_at' => 'datetime'
    ];

    protected function firstname(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }

    protected function lastname(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
}
