<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Photo;


class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = (new Group())->newQuery();
        $grupe = $query->orderBy('redni')->get();
        return view('back.layouts.categories.index')->with('grupe',$grupe);
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
      $group = new Group();
      $stored = $group->validateRequest($request)->storeData($request); // vraća id grupe
      if ($stored)
      {
        if ($request->hasFile('image')) {
          $path = Photo::imageUpload($request->file('image'), Group::find($stored), 'groups', 'image');
          $group->updateImagePath($stored, $path);
      }
      return redirect('/group')->with(['success' => 'Grupa uspješno spremljena!']);
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
      $grupa = Group::find($id);
      return view('back.layouts.categories.grupa')->with('grupa',$grupa);
    }
    public function front_show($id)
    {
      $grupa = Group::find($id);
      return view('front_layouts.kategorije.grupa')->with('grupa',$grupa);
    
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
        $grupa = Group::find($id);
        $updated = $grupa->validateRequest($request)->updateData($request,$id);
        if ($updated)
        {
          if ($request->hasFile('image')) {
            $path = Photo::imageUpload($request->file('image'), $grupa, 'groups', 'image');
            $grupa->updateImagePath($id, $path);
        }
      //   return redirect('/group')->with(['success' => 'Grupa uspješno spremljena!']);
      return redirect()->route('grupa', [$grupa])->with(['success' => 'Grupa uspješno spremljena!']);
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
        $grupa = Group::find($id);
        if ($grupa->image != NULL)
        {
          Photo::imageDelete($grupa, 'groups', 'image');
        }
        $grupa->delete();
        return redirect('/group')->with(['success' => 'Grupa je uspješno obrisana!']);

        // dodati opcije brisanja kategorija i podkategorija

    }
}
