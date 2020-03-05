<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Call extends Eloquent
{
    protected $connection = 'mongodb';
    protected $guarded = [];
}
