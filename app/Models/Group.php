<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Group extends Model
{
  //  use HasFactory;
  public function validateRequest(Request $request)
{
  $request->validate([
      'name'  => 'required',
  ]);

  $this->setRequest($request);

  return $this;
}

public static function storeData($request)
{
    return self::insertGetId([
        'name' => $request->name,
        'description' => $request->description,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
}
public static function updateData($request, $group_id)
  {
    if($request->live == 'on')
     $live = 'da';
    else
     $live = 'ne';

      return self::where('id', $group_id)->update([
        'name' => $request->name,
        'description' => $request->description,
        'live' => $live,
        'slug' => $request->slug,
        'redni' => $request->redni,
        'updated_at' => Carbon::now()
      ]);
  }
private function setRequest($request)
  {
      $this->request = $request;
  }
  public function updateImagePath($group_id, $path)
    {
        return Group::where('id', $group_id)->update([
            'image' => $path
        ]);
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'group_id')->orderBy('redni');
    }
}
