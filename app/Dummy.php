<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Dummy extends Eloquent
{

    protected $connection = 'db_meal';
    protected $collection = 'meal_info';
}
