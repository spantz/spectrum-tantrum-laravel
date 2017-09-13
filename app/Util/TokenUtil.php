<?php

namespace App\Util;

class TokenUtil
{
    const DELIMITER = '_';
    const USER = 'USER';
    const DEVICE = 'DEVICE';
    const TYPE_INDEX = 0;
    const ID_INDEX = 1;
    const TIMESTAMP_INDEX = 2;

    /**
     * Encrypts a token and returns it
     *
     * @param $tokenToEncrypt
     * @return String
     */
    public static function encryptToken($tokenToEncrypt) : String
    {
        return encrypt($tokenToEncrypt);
    }

    /**
     * Decrypts a token and returns it
     *
     * @param $tokenToDecrypt
     * @return String
     */
    public static function decryptToken($tokenToDecrypt) : String
    {
        return decrypt($tokenToDecrypt);
    }

}