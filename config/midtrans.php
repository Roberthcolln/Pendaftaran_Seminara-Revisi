<?php

return [
    'serverKey'     => env('MIDTRANS_SERVER_KEY'),
    'clientKey'     => env('MIDTRANS_CLIENT_KEY'),
    'isProduction'  => env('MIDTRANS_IS_PRODUCTION'),
    'isSanitized'   => env('MIDTRANS_IS_SANITIZED'),
    'is3ds'         => env('MIDTRANS_IS_3DS'),

    'finish_redirect_url' => env('MIDTRANS_FINISH_REDIRECT_URL', 'https://example.com/finish'),
    'unfinish_redirect_url' => env('MIDTRANS_UNFINISH_REDIRECT_URL', 'https://example.com/unfinish'),

];
