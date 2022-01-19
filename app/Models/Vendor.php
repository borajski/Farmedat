<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Follower;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
  //  use HasFactory;
  public function validateRequest(Request $request)
{
  $request->validate([
      'name'  => 'required',
      'oib' => 'required',
      'address' => 'required',
      'city' => 'required',
      'interes' => 'required'
  ]);

  $this->setRequest($request);

  return $this;
}
private function setRequest($request)
  {
      $this->request = $request;
  }
  public static function storeData($user_id)
{
    return self::insertGetId([
        'user_id' => $user_id,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
}
  public static function updateData($request, $id)
    {
      if($request->live == 'on')
       $live = 'da';
      else
       $live = 'ne';

        return self::where('id', $id)->update([
            'name' => $request->name,
            'oib' => $request->oib,
            'address' => $request->address,
            'zip' => $request->zip,
            'city' => $request->city,
            'description' => $request->description,
            'plan_id' => $request->plan,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'interes' => $request->interes,
            'live' => $live,
            'updated_at' => Carbon::now()
        ]);
    }
    public function updateImagePath($id, $path)
      {
          return Vendor::where('id', $id)->update([
              'logo' => $path
          ]);
      }
      public function updateCoverPath($id, $path)
        {
            return Vendor::where('id', $id)->update([
                'cover' => $path
            ]);
        }
  public function user()
  {
      return $this->belongsTo(User::class);
  }
  public function products()
  {
      return $this->hasMany(Product::class, 'vendor_id');
  }
  public function orders()
  {
      return $this->hasMany(Order::class, 'vendor_id');
  }
  public function followers()
  {
      return $this->hasMany(Follower::class, 'vendor_id');
  }
  
}
