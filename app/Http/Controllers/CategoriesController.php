<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Group;

class CategoriesController extends Controller
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
      $kategorija = new Category();
      $stored = $kategorija->validateRequest($request)->storeData($request); // vraća id Kategorije
     if ($stored)
      {
        if ($request->hasFile('image')) {
          $path = Photo::imageUpload($request->file('image'), Category::find($stored), 'categories', 'image');
          $kategorija->updateImagePath($stored, $path);
      }
      $grupa = Category::find($stored)->group;
      return redirect()->route('grupa', [$grupa])->with(['success' => 'Kategorija je  uspješno dodana!']);
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
      $kategorija = Category::find($id);
      return view('back.layouts.categories.kategorija')->with('kategorija',$kategorija);
    }
    public function front_show($id)
    {
      $kategorija = Category::find($id);
      return view('front_layouts.kategorije.kategorija')->with('kategorija',$kategorija);
    
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
      $kategorija = Category::find($id);
      $updated = $kategorija->validateRequest($request)->updateData($request,$id);
      if ($updated)
      {
        if ($request->hasFile('image')) {
          $path = Photo::imageUpload($request->file('image'), $kategorija, 'categories', 'image');
          $kategorija->updateImagePath($id, $path);
      }
    //   return redirect('/group')->with(['success' => 'Grupa uspješno spremljena!']);
    return redirect()->route('kategorija', [$kategorija])->with(['success' => 'Kategorija uspješno spremljena!']);
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
      $kategorija = Category::find($id);
      if ($kategorija->image != NULL)
      {
        Photo::imageDelete($kategorija, 'categories', 'image');
      }
      $grupa = $kategorija->group;
      $kategorija->delete();
      return redirect()->route('grupa', [$grupa])->with(['success' => 'Kategorija je  uspješno obrisana!']);
    }
}
