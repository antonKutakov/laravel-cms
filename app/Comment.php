<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    const IS_ALLOWED = 1;
    const IS_DISALLOWED = 0;

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allow(){
        $this->status = Comment::IS_ALLOWED;
        $this->save();
    } 

    public function disAllow(){
        $this->status = Comment::IS_DISALLOWED;
        $this->save();
    }

    public function toggleStatus(){
        if($this->status == 0){
            return $this->allow();
        }
        return $this->disAllow();
    }

    public function remove(){
        $this->delete();
    }
}
