<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Customer extends \Konekt\Customer\Models\Customer
{
    public function getName(): string
    {
        if ($this->type->isRobot()) {
            return 'Robot ' . $this->firstname;
        }

        return parent::getName();
    }

    public static function updateProfile($customer_id,$data)
    {
        Customer::where('id',$customer_id)
            ->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'phone' => $data['phone']
            ]);

        //Helper::getAddressId
        //CustomerAddress::setAddressId

        return true;
    }
}
