<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UMEvent extends Eloquent
{
    protected $connection = 'um_api';
    protected $collection = 'event';
}
