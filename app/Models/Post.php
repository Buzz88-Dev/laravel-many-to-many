<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Slugger;

class Post extends Model
{
    use Slugger;

    protected $fillable = [
        'title', 'content', 'excerpt', 'category_id', 'image', 'slug'
    ];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
