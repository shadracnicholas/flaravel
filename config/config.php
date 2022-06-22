<?php

/*
 * Package configuration
 */
return [
    /**
     * Sign up on https://flutterwave.com/ to get the below details from your settings page
     */

    'publicKey' => env('FLW_PUBLIC_KEY'),
    'secretKey' => env('FLW_SECRET_KEY'),
    'secretHash' => env('FLW_SECRET_HASH', ''),
    'encryptionKey' => env('FLW_ENCRYPTION_KEY', ''),
];