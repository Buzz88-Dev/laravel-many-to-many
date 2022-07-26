<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugger;

class Post extends Model
{
    use Slugger;

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
