<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 27/12/17
 * Time: 17:43
 */

namespace AeroTransfers\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Email is already taken'
        ],
    ];

}