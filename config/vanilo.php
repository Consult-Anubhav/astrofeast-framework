<?php

return [
    'user' => [],
    'cart' => [
        'session_key'       => 'cart',
        'auto_destroy'      => false,
        'auto_assign_user'  => true,
        'extra_product_attributes' => ['weight']
    ]
];
