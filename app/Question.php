<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function category(){
        return $this->belongsTo('App\Questioncategory');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}