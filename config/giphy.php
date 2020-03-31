<?php

return [
    'default' => env('GIF_DRIVER', 'faker'),
    'providers' => [
        'faker' => [
            'driver' => 'faker',
        ],
        'giphy' => [
            'driver' => 'giphy',
            'base_url' => env('GIPHY_URL', 'http://api.giphy.com'),
            'api_key' => env('GIPHY_API_KEY', ''),
        ],
    ],
];