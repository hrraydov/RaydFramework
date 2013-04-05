<?php

namespace Framework;

class Validation {

    public static function isBetween($val, $min, $max) {
        if (strlen($val) >= $min && strlen($val) <= $max)
            return true;
        else
            return false;
    }

    public static function matches($val1, $val2) {
        if ($val1 == $val2)
            return true;
        else
            return false;
    }

    public static function matchesStrict($val1, $val2) {
        if ($val1 === $val2)
            return true;
        else
            return false;
    }

    public static function isEmail($val) {
        if (filter_var($val, \FILTER_VALIDATE_EMAIL))
            return true;
        else
            return false;
    }

}

