<?php

namespace App\Http\Controllers;

use App\AppUsers;
use Illuminate\Http\Request;

class AppUsersController extends Controller
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
    public function adminIndex()
    {
        $parkingUser = AppUsers::get();
        return view('parkingUser.index',compact('parkingUser'));
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
    
    /**
     * Display the specified resource.
     *
     * @param  \App\AppUsers  $appUsers
     * @return \Illuminate\Http\Response
     */
    public function show(AppUsers $appUsers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AppUsers  $appUsers
     * @return \Illuminate\Http\Response
     */
    public function edit(AppUsers $appUsers)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppUsers  $appUsers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppUsers $appUsers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppUsers  $appUsers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppUsers $appUsers)
    {
        //
    }
   
    
    
   
}
