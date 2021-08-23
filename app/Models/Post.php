<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    public function taxonomy(){

        return $this->belongsToMany('App\Models\Taxonomy','taxonomy_relationships');
    }

     use SoftDeletes;


}
