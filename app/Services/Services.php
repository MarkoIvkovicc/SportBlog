<?php 

namespace App\Services;


class Services {

    public static $register = [];

    public static function get($key) {
        return static::$register[$key];
    }

    public static function set ($key, $value) {
        static::$register[$key] = $value;
    }
}