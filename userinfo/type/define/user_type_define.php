<?php
namespace GraphQL\userinfo\type\define;

require_once(dirname(__FILE__).'/../user_type.php');

use GraphQL\userinfo\type\user_type;

class user_type_define
{
    private static $user;

    public static function user() {
        return static::$user ??= new user_type();
    }
}

