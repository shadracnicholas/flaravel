<?php

namespace Shadracnicholas\Flaravel\Helpers;


class Helper
{

    public static function encrypt3Des(array $data, $key)
    {
        $encData = openssl_encrypt(json_encode($data), 'DES-EDE3', $key, OPENSSL_RAW_DATA);
        return base64_encode($encData);
    }

}