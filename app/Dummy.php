<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Dummy extends Eloquent
{
    protected $connection = 'um_api';
    protected $collection = 'meal_consumption';
}
