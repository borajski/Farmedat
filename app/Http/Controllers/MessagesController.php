<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;


class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $query = (new Message())->newQuery();
      $messages = $query->where('parent_id',0)->orderBy('created_at', 'desc')->get();
      return view('back.layouts.messages.index')->with('messages',$messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  return view('back.layouts.messages.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    /*  if ( ! $request->has('recipient')) {
          $request->recipient = $request->input('id');
      } */

      $message        = new Message();
      $message_stored = $message->validateRequest($request)->storeData();

      // event(new MessageSent($message_stored));

      if ($message_stored) {
        if ($message_stored->parent_id == 0)
        {
          return redirect()->route('poruke')->with(['success' => 'Poruka je uspješno snimljena.!']);
        }

        else
        {
            $id = $message_stored->parent_id;
            return redirect()->route('poruka', [$id]);
        }

      }

      return redirect()->back()->with(['error' => 'Whoops..! Došlo je do greške sa snimanjem poruke.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $poruke = Message::where('id',$id)->orWhere('parent_id',$id)->get();
      return view('back.layouts.messages.poruka')->with('poruke',$poruke);
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
      $poruka = Message::find($id);
      if ($poruka->parent_id == 0)
      {
        $poruke = Message::where('parent_id',$id)->orWhere('id',$id)->delete();
        return redirect()->route('poruke')->with(['success' => 'Poruka je uspješno obrisana!']);
      }

      else
      {
          $id = $poruka->parent_id;
          $poruka->delete();
          return redirect()->route('poruka', [$id])->with(['success' => 'Poruka je uspješno obrisana!']);
      }

    }
    public static function getUserId(Request $request)
    {
      $korisnik = User::where('name',$request->ime)->first();
      if ($korisnik)
        return response()->json($korisnik->id);
      else
        return response()->json("0");
    }
}
