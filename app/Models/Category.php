<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Http\Request;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\Subcategory;
use App\Models\Product;

class Category extends Model
{
    // use HasFactory;
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
          'group_id' => $request->group_id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);
  }
  public static function updateData($request, $cat_id)
    {
      if($request->live == 'on')
       $live = 'da';
      else
       $live = 'ne';

        return self::where('id', $cat_id)->update([
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
    public function updateImagePath($cat_id, $path)
      {
          return Category::where('id', $cat_id)->update([
              'image' => $path
          ]);
      }
      public function group()
      {
       return $this->belongsTo(Group::class);
      }
      public function subcategories()
      {
          return $this->hasMany(Subcategory::class, 'category_id')->orderBy('redni');
      }
      public function products()
      {
          return $this->hasMany(Product::class, 'category');
      }
}
