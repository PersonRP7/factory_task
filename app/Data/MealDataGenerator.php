<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;

class MealDataGenerator
{
    public static function diffTimeComparison($queryParameter)
    {
        if (!ctype_digit($queryParameter))
        {
            return false;
        }
        return true;
    }
}
