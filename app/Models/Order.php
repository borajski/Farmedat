<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class Order extends Model
{
    // use HasFactory;
    public function validateRequest(Request $request)
  {
      // Validate the request.
      $request->validate([
          'pay_fname'   => 'required',
          'pay_lname'   => 'required',
          'pay_address' => 'required',
          'pay_city'    => 'required',
          'pay_zip'     => 'required',
          'pay_phone'   => 'required',
          'pay_email'   => 'required',
          'payment'     => 'required',
          'delivery'    => 'required',
          'ship_fname'  => 'required',
          'ship_lname'  => 'required',
          'ship_address'=> 'required',
          'ship_city'   => 'required',
          'ship_zip'    => 'required',
          'ship_phone'  => 'required',
          'ship_email'  => 'required',
          'payment'     => 'required',
          ]);

      // Set Product Model request variable
      $this->setRequest($request);

      return $this;
  }
  public function validateUpdateRequest(Request $request)
  {
      // Validate the request.
      $request->validate([
          'status'   => 'required',
         ]);

      // Set Product Model request variable
      $this->setRequest($request);

      return $this;
  }
  private function setRequest($request)
    {
        $this->request = $request;
    }
    public function store($id = null)
  {
      $order = $id ? $this->updateData($id) : $this->storeData();
      if ($order)
          return $order;
      else
          return false;
  }
    private function storeData()
      {
          $id = $this->insertGetId([
              'user_id'          => Auth()->User()->id,
              'vendor_id'        => $this->request->vendor_id,
              'order_status'     => 0,
              'total'            => $this->request->total,
              'payment_fname'    => $this->request->pay_fname,
              'payment_lname'    => $this->request->pay_lname,
              'payment_address'  => $this->request->pay_address,
              'payment_city'     => $this->request->pay_city,
              'payment_zip'      => $this->request->pay_zip,
              'payment_phone'    => $this->request->pay_phone,
              'payment_email'    => $this->request->pay_email,
              'payment_method'   => $this->request->payment,
              'shipping_fname'    => $this->request->ship_fname,
              'shipping_lname'    => $this->request->ship_lname,
              'shipping_address'  => $this->request->ship_address,
              'shipping_city'     => $this->request->ship_city,
              'shipping_zip'      => $this->request->ship_zip,
              'shipping_phone'    => $this->request->ship_phone,
              'shipping_email'    => $this->request->ship_email,
              'shipping_method'    => $this->request->delivery,
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
          'order_status'     => $this->request->status,
          'updated_at'       => Carbon::now()
        ]);

        if ($updated) {
          return $this->find($id);

        }

        return "nešto ne valja";
    }
      public function vendor()
      {
          return $this->belongsTo(Vendor::class);
      }
      public function user()
      {
          return $this->belongsTo(User::class);
      }
}
