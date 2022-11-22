<?php
namespace App\Data;

class ErrorHandler
{
    public static function generic($function, $request)
    {
        return $function($request);
    }
}