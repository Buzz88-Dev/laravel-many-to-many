<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugger;

class Category extends Model
{
    use Slugger;
    public $timestamps = false;
}
