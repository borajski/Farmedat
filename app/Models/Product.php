<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductImage;
use App\Models\ProductAction;
use App\Models\Vendor;

class Product extends Model
{
    // use HasFactory;
    public function validateRequest(Request $request)
  {
      // Validate the request.
      $request->validate([
          'name'        => 'required',
          'sku'         => 'required',
          'description' => 'required',
          'category'    => 'required',
          'subcategory' => 'required'
      ]);

      // Set Product Model request variable
      $this->setRequest($request);

      return $this;
  }
  public function store($id = null)
{
    $product = $id ? $this->updateData($id) : $this->storeData();
    if ($product)
        return $product;
    else
        return false;
}
private function storeData()
  {
    if($this->request->live == 'on')
     $live = 'da';
      else
     $live = 'ne';

      $id = $this->insertGetId([
          'vendor_id'        => $this->request->vendor,
          'name'             => $this->request->name,
          'description'      => $this->request->description,
          'category'         => $this->request->category,
          'subcategory'      => $this->request->subcategory,
          'sku'              => $this->request->sku,
          'price'            => isset($this->request->price) ? $this->request->price : 0,
          'quantity'         => isset($this->request->quantity) ? $this->request->quantity : 1,
          'measure_unit'     => $this->request->measure_unit,
          'delivery_type'    => $this->request->delivery,
          'min_order'        => $this->request->min_order,
          'delivery_price'   => $this->request->del_price,
          'delivery_include' => $this->request->del_in_price,
          'live'             => $live,
          'created_at'       => Carbon::now(),
          'updated_at'       => Carbon::now()
      ]);

      if ($id) {
          return $this->find($id);
      }

      return false;
  }

  private function updateData($id)
    {

      if($this->request->live == 'on')
       $live = 'da';
        else
       $live = 'ne';

        $updated = $this->where('id', $id)->update([
          'name'             => $this->request->name,
          'description'      => $this->request->description,
          'category'         => $this->request->category,
          'subcategory'      => $this->request->subcategory,
          'sku'              => $this->request->sku,
          'price'            => isset($this->request->price) ? $this->request->price : 0,
          'quantity'         => isset($this->request->quantity) ? $this->request->quantity : 1,
          'measure_unit'     => $this->request->measure_unit,
          'delivery_type'    => $this->request->delivery,
          'min_order'        => $this->request->min_order,
          'delivery_price'   => $this->request->del_price,
          'delivery_include' => $this->request->del_in_price,
          'live'             => $live,
            'updated_at'       => Carbon::now()
        ]);

        if ($updated) {
          return $this->find($id);

        }

        return "nešto ne valja";
    }
    private function setRequest($request)
      {
          $this->request = $request;
      }
      public function subcategory()
      {
       return $this->belongsTo(Subcategory::class);
      }
      public function category()
      {
       return $this->belongsTo(Category::class);
      }
      public function updateImagePath($product_id, $path)
        {
            return Product::where('id', $product_id)->update([
                'image' => $path
            ]);
        }
        public function productimages()
        {
            return $this->hasMany(ProductImage::class, 'product_id');
        }
        public function vendor()
        {
            return $this->belongsTo(Vendor::class);
        }
        public function productactions()
        {
            return $this->hasOne(ProductAction::class, 'product_id');
        }
  }
