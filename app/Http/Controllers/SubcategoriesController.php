<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Subcategory;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      $podkategorija = new Subcategory();
      $stored = $podkategorija->validateRequest($request)->storeData($request); // vraća id Kategorije
     if ($stored)
      {
        if ($request->hasFile('image')) {
          $path = Photo::imageUpload($request->file('image'), Subcategory::find($stored), 'subcategories', 'image');
          $podkategorija->updateImagePath($stored, $path);
      }
      $kategorija = Subcategory::find($stored)->category;
      return redirect()->route('kategorija', [$kategorija])->with(['success' => 'Podategorija je  uspješno dodana!']);
      }
      else {
         return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $podkategorija = Subcategory::find($id);
      return view('back.layouts.categories.podkategorija')->with('podkategorija',$podkategorija);
    }
    public function front_show($id)
    {
      $podkategorija = Subcategory::find($id);
      return view('front_layouts.kategorije.podkategorija')->with('podkategorija',$podkategorija);
    
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
      $podkategorija = Subcategory::find($id);
      $updated = $podkategorija->validateRequest($request)->updateData($request,$id);
      if ($updated)
      {
        if ($request->hasFile('image')) {
          $path = Photo::imageUpload($request->file('image'), $podkategorija, 'subcategories', 'image');
          $podkategorija->updateImagePath($id, $path);
      }
    //   return redirect('/group')->with(['success' => 'Grupa uspješno spremljena!']);
    return redirect()->route('podkategorija', [$podkategorija])->with(['success' => 'Podkategorija uspješno spremljena!']);
      }
      else {
         return redirect()->back()->with(['error' => 'Uf! Došlo je do pogreške u spremanju podataka!']);
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
      $podkategorija = Subcategory::find($id);
      if ($podkategorija->image != NULL)
      {
        Photo::imageDelete($podkategorija, 'subcategories', 'image');
      }
      $kategorija = $podkategorija->category;
      $podkategorija->delete();
      return redirect()->route('kategorija', [$kategorija])->with(['success' => 'Podkategorija je  uspješno obrisana!']);
    }

}
