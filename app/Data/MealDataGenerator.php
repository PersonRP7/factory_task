<?php
namespace App\Data;

// use App\Data\MealDataGenerator;

use App\Models\Meal;
use Carbon\Carbon;

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
