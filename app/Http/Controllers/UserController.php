<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyList(Request $request)
    {
        if (Auth::user()== null){
            return redirect('login');
        }
        if (!Auth::user()->status) {
            return view('block');
        }
        $list = $request->input('listUsers');
        $ids = explode(",", $list);
        User::whereIn('id', $ids)->delete();
        return redirect('/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function block(Request $request)
    {
        if (Auth::user()== null){
            return redirect('login');
        }
        if (!Auth::user()->status) {
            return view('block');
        }
        $list = $request->input('listUsers');
        $ids = explode(",", $list);
        $listUsers = User::whereIn('id', $ids)->get();
        foreach ($listUsers as $user){
            $user->status = 0;
            $user->save();
        }
        return redirect('/home');
    }
    public function unblock(Request $request)
    {
        var_dump(Auth::user());
        if (Auth::user()== null){
            return redirect('login');
        }
        if (!Auth::user()->status) {
            return view('block');
        }
        $list = $request->input('listUsers');
        $ids = explode(",", $list);
        $listUsers = User::whereIn('id', $ids)->get();
        foreach ($listUsers as $user){
            $user->status = 1;
            $user->save();
        }
        return redirect('/home');
    }
}
