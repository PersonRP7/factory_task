<?php

namespace App;
use App\Models\Category;

class MyApiClient 
{
    public static function helloWorld()
    {
        return "Hello World";
    }
    
    public static function category1()
    {
        return Category::first();
    }
}
