<?php

namespace App\Models;
use App\Models\User;
use App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
   public function user()
    {
        return $this->belongsTo(User::class,'follower','id');
    } 
  public function vendor()
  {
      return $this->belongsTo(Vendor::class);
  }
}
