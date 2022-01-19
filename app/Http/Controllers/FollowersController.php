<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;


class FollowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = auth()->user()->vendors;
        $query = (new Follower())->newQuery()->where('vendor_id',$vendor->id)->whereIn('f_status',['customer','vendor','admin']);
        $followers = $query->orderBy('created_at')->get();
        return view('back.layouts.followers.index')->with('followers',$followers);

    }
    public function index_buyers()
    {
        $vendor = auth()->user()->vendors;
        $query = (new Follower())->newQuery()->where('vendor_id',$vendor->id)->where('f_status','buyer');
        $followers = $query->orderBy('created_at')->get();
        return view('back.layouts.followers.kupci')->with('followers',$followers);
    }
    public function index_follow()
    {
        $id = auth()->user()->id;
        $query = (new Follower())->newQuery()->where('follower',$id)->where('f_status','!=','buyer');
        $followers = $query->orderBy('created_at')->get();
        return view('back.layouts.followers.pratim')->with('followers',$followers);
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
    public function spremi($index)
    {
        $follower = new Follower();
        // $user = auth()->user()->id;
        $follower->vendor_id = $index;
        $follower->follower = auth()->user()->id;
        $follower->f_status = auth()->user()->details->role;
        $adresa = "/prodavac/".$index;

         
        if ($follower->save())
        {
        return redirect($adresa)->with(['success' => 'Prodavač je dodan u krug povjerenja!']);
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
        //
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
        //
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
