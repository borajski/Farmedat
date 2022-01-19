<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Photo;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $query = (new Vendor())->newQuery();
      $prodavaci= $query->orderBy('name')->get();
      return view('back.layouts.vendors.index')->with('prodavaci',$prodavaci);
    }

    public function front_index()
    {
      $query = (new Vendor())->newQuery();
      $prodavaci= $query->orderBy('name')->get();
      return view('front_layouts.prodavaci.index')->with('prodavaci',$prodavaci);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $prodavac = Vendor::find($id);
      return view('back.layouts.vendors.prodavac')->with('prodavac',$prodavac);
    }
    public function front_show($id)
    {
      $prodavac = Vendor::find($id);
      return view('front_layouts.prodavaci.prodavac')->with('prodavac',$prodavac);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $prodavac = Vendor::find($id);
      return view('back.layouts.vendors.edit')->with('prodavac',$prodavac);
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
      $prodavac = Vendor::find($id);
      $updated = $prodavac->validateRequest($request)->updateData($request,$id);
      if ($updated)
      {
        if ($request->hasFile('image')) {
          $path = Photo::imageUpload($request->file('image'), $prodavac, 'vendors', 'logo');
          $prodavac->updateImagePath($id, $path);
      }
      if ($request->hasFile('cover')) {
        $path = Photo::imageUpload($request->file('cover'), $prodavac, 'vendors', 'cover');
        $prodavac->updateCoverPath($id, $path);
    }
      if (auth()->user()->details->role == "admin")
      {
        return redirect()->route('vendor.show',$id)->with(['success' => 'Podaci o prodavaču su uspješno spremljeni!']);
      }
      else {
      return redirect('/profile')->with(['success' => 'Podaci o prodavaču su uspješno spremljeni!']);
      }

      }

      else
       return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
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
