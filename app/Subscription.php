<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    public static function add($email){
        $sub = new static;
        $sub->email = $email;
        $sub->token = str_random(100);
        $sub->save();
        return $sub;
    }

    public function remove(){
        $this->delete();
    }
}
