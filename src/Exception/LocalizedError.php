<?php

namespace Omnipay\Payture\Exception;

/**
 * Payture protocol errors english localization.
 */
abstract class LocalizedError
{
    protected static $_errors = [
    ];

    /**
     * @param string $code
     * @return string
     */
    final public static function findMessage($code)
    {
        $code = self::getExistingCode((string) $code);
        return static::$_errors[$code];
    }

    /**
     * @param string $code
     * @return string
     */
    private static function getExistingCode($code)
    {
        if (!self::errorExists($code)) {
            $code = SystemError::UNKNOWN;
        }
        return $code;
    }

    /**
     * @param string $code
     * @return boolean
     */
    private static function errorExists($code)
    {
        return array_key_exists($code, static::$_errors);
    }
}
