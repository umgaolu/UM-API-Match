<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UMEvent extends Eloquent
{
    protected $connection = 'um_api';
    protected $collection = 'event';
}
