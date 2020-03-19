<?php
return [
    'v3' => [
        'public_key' => env('GOOGLE_RECAPTCHA_PUBLIC_KEY'),
        'private_key' => env('GOOGLE_RECAPTCHA_PRIVATE_KEY'),
        'minimum_score' => 0.6,
    ]
];