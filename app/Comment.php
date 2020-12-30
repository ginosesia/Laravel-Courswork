<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //table name
    protected $table = 'comments';
    //primaryKey 
    public $promaryKey = 'id';
    //timestamp
    public $timestamps = true;
    

    public function post() {
        return $this->belongsTo('App\Post');
    }

}
