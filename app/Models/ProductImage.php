<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductImage extends Model
{
    //use HasFactory;
    public static function storeImage($request,$id)
    {
        return self::insertGetId([
            'product_id' => $id,
            'alt' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
    public function updateImagesPath($image_id, $path)
      {
          return ProductImage::where('id', $image_id)->update([
              'image' => $path
          ]);
      }
      public function product()
      {
       return $this->belongsTo(Product::class);
      }
}
