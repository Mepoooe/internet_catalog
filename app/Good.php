<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
   public function userdata() {
    return $this->belongsTo('\App\User', 'user_id', 'id');
   }
}
