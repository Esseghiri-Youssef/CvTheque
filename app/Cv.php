<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cv extends Model
{
    use SoftDeletes;

    public function user(){

        return $this->belongsTo('App\user');
    }
    
    public function experiences(){

        return $this->hasMany('App\Experience');

    }
    
    
}
