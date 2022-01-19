<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductAction;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Follower;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // pregled naručenog (prodanog)
    public function index()
    {
      if ((auth()->user()->details->role) == 'admin')
      {
      $query = (new Order())->newQuery();
      $narudzbe = $query->orderBy('created_at')->get();
      return view('back.layouts.orders.index')->with('narudzbe',$narudzbe);
      }
      else {
        $vendor = auth()->user()->vendors;
        $query = (new Order())->newQuery()->where('vendor_id',$vendor->id);
        $narudzbe = $query->orderBy('created_at')->get();
        return view('back.layouts.orders.index')->with('narudzbe',$narudzbe);
      }
    }
    // pregled naručenog (kupljenog)
    public function index_buy()
    {
      $query = (new Order())->newQuery()->where('user_id',auth()->user()->id);
      $naruceno = $query->orderBy('created_at')->get();
      return view('back.layouts.orders.index_buy')->with('naruceno',$naruceno);     
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $order         = new Order();
      $order_created = $order->validateRequest($request)->store();

      if ($order_created)
      {
        for ($i=1; $i <= $request->broj_proizvoda ; $i++) {
          $naruceni = new OrderProduct();
          $naruceni->order_id = $order_created->id;
          $index1 = 'prod_id'.$i;
          $index2 = 'name'.$i;
          $index3 = 'price'.$i;
          $index4 = 'quantity'.$i;
          $naruceni->product_id = $request->$index1;
          $naruceni->name = $request->$index2;
          $naruceni->price = $request->$index3;
          $naruceni->quantity = $request->$index4;
          $naruceni->total = $request->$index3 * $request->$index4;
          $naruceni->save();
        }
          // dodavanje kupca kao followera sa statusom 'buyer'
          // Treba provjeriti nije li već follower
          // Treba ostati ulogiran nakon redirekcije
          $follower = new Follower();
          $follower->vendor_id = $order_created->vendor_id;
          $follower->follower = $order_created->user_id;
          $follower->f_status = "buyer";
          $follower->save();
          
          session()->flush();
          return redirect('/')->with(['success' => 'Narudžba je uspješno poslana!']);
      }

      else
        return redirect()->back()->with(['error' => 'Whoops..! Greška u procesuiranju narudžbe']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $narudzba = Order::find($id);
      return view('back.layouts.orders.narudzba')->with('narudzba',$narudzba);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $order         = new Order();
      $order_updated = $order->validateUpdateRequest($request)->store($id);
      if ($order_updated) {
        return redirect('/narudzbe')->with(['success' => 'Narudžba je uspješno spremljena!']);
      } else {
        return redirect()->back()->with(['error' => 'Whoops..! Greška u procesuiranju narudžbe']);
   
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
