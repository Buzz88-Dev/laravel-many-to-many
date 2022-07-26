<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugger;

class Post extends Model
{
    use Slugger;
}
