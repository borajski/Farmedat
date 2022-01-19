<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class Subcategory extends Model
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
        'category_id' => $request->category_id,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ]);
}
public static function updateData($request, $scat_id)
  {
    if($request->live == 'on')
     $live = 'da';
    else
     $live = 'ne';

      return self::where('id', $scat_id)->update([
        'name' => $request->name,
        'description' => $request->description,
        'slug' => $request->slug,
        'redni' => $request->redni,
        'live' => $live,
        'updated_at' => Carbon::now()
      ]);
  }
private function setRequest($request)
  {
      $this->request = $request;
  }
  public function updateImagePath($scat_id, $path)
    {
        return Subcategory::where('id', $scat_id)->update([
            'image' => $path
        ]);
    }
    public function category()
    {
     return $this->belongsTo(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory');
    }
  
}
