<?php
/**
 * Created by PhpStorm.
 * User: sergiomoreno
 * Date: 28/12/17
 * Time: 2:19
 */

namespace AeroTransfers\Domain\Auth;

use AeroTransfers\Infrastructure\Model\Users;

class Auth
{
    public function user() {
        return Users::find($_SESSION['user']);
    }

    public function check() {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password)
    {
        $user = Users::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }
    
    public function logOut()
    {
        unset($_SESSION['user']);
    }
}
