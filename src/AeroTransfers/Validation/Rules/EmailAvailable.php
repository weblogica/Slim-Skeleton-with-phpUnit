<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 27/12/17
 * Time: 17:33
 */

namespace AeroTransfers\Validation\Rules;

use AeroTransfers\Infrastructure\Model\Users;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule
{
    function validate($input)
    {
        return Users::Where('email', $input)->count() === 0;
    }
}