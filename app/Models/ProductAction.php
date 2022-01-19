<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Product;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAction extends Model
{
    //use HasFactory;
    public function validateRequest(Request $request)
  {
      // Validate the request.
      $request->validate([
          'name'        => 'required',
          'product'         => 'required',
          'date_start' => 'required',
          'date_end'    => 'required',
          'discount' => 'required_without:price',
          'price' => 'required_without:discount'
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
        $id = $this->insertGetId([
            'name'             => $this->request->name,
            'product_id'       => $this->request->product,
            'price'            => $this->request->price,
            'discount'         => $this->request->discount,
            'date_start'       => new Carbon($this->request->date_start),
            'date_end'         => new Carbon($this->request->date_end),
            'coupon'           => $this->request->coupon,
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
          $updated = $this->where('id', $id)->update([
            'name'             => $this->request->name,
            'product_id'       => $this->request->product,
            'price'            => $this->request->del_price,
            'discount'         => $this->request->discount,
            'date_start'       => new Carbon($this->request->date_start),
            'date_end'         => new Carbon($this->request->date_end),
            'coupon'           => $this->request->coupon,
            'created_at'       => Carbon::now(),
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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
