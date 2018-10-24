<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class RC extends Eloquent
{
    protected $connection = 'um_api';
    protected $collection = 'rc';
}
