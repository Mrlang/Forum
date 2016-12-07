<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title','body','user_id','last_user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function abc(){
        return $this->belongsTo(User::class);
    }

    //拿到一个discussion就可以以此方法去取出它的Comments
    public function getCom(){
        return $this->hasMany(Comment::class);
    }

}
