<?php

return [
    'purchase_status_admin_user' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your purchase is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your pacakge has been processed and will be with our delivery parter soon'
        ],
        'dropped_off' => [
            'status' => 'Dropped Off',
            'details' => 'Your package has been dropped off by the seller'
        ],
        'shipped' => [
            'status' => 'Shipped',
            'details' => 'Your package has arrived at our logistics facility'
        ],
        'out_for_delivery' => [
            'status' => 'Out For Delivery',
            'details' => 'Our delivery partner will attempt to delivery your package'
        ],
        'delivered' => [
            'status' => 'Delivered',
            'details' => 'Delivered'
        ],
        'canceled' => [
            'status' => 'Canceled',
            'details' => 'Canceled'
        ]

    ],

    'purchase_status_thirdParty' => [
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your purchase is currently pending'
        ],
        'processed_and_ready_to_ship' => [
            'status' => 'Processed and ready to ship',
            'details' => 'Your pacakge has been processed and will be with our delivery parter soon'
        ]
    ]
];