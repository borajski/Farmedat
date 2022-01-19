<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductAction;

class ProductActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    if (auth()->user()->details->role == 'admin')
    {
      $query = (new ProductAction())->newQuery();
      $akcije = $query->orderBy('date_start')->get();
      return view('back.layouts.products.actions')->with('akcije',$akcije);
    }
    else
    {
      $proizvodi = auth()->user()->vendors->products;
    $query = (new ProductAction())->newQuery()->whereIn('product_id',$proizvodi);
    $akcije = $query->orderBy('date_start')->get();
  //  $akcije = ProductAction::with($proizvodi)->get();

      return view('back.layouts.products.actions')->with('akcije',$akcije);

    }
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
      $action         = new ProductAction();
      $action_created = $action->validateRequest($request)->store();
      if ($action_created)
      {
          return redirect('/proizvodi_akcije')->with(['success' => 'Akcija je uspješno spremljena!']);
      }

      else
        return redirect()->back()->with(['error' => 'Whoops..! There was an error saving the product.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $akcija = ProductAction::find($id);
      return view('back.layouts.products.action_edit')->with('akcija',$akcija);
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
      $akcija         = new ProductAction();
      $action_updated = $akcija->validateRequest($request)->store($id);

      if ($action_updated) {
        return redirect('/proizvodi_akcije')->with(['success' => 'Akcija je uspješno spremljena!']);
      }

      return redirect()->back()->with(['error' => 'Whoops..! Došlo je do greške sa snimanjem proizvoda.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $akcija = ProductAction::find($id);
        $akcija->delete();
        return redirect('/proizvodi_akcije')->with(['success' => 'Akcija je uspješno obrisana!']);
    }
}
