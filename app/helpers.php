<?php

if (! function_exists("generatePatientNumber")) {
    function generatePatientNumber()
    {
        $timestamp = time();
        $randomNumber = "PTN-" . mt_rand(1000, 9999) + $timestamp;

        return $randomNumber;
    }
}

if (! function_exists('underscoreToCamelCase')) {
    function underscoreToCamelCase($str)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
    }
}