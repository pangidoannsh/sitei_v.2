<?php

namespace App\Http\Controllers;

use App\Models\developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fahril()
    {
        return view('developer.fahril');
    }
    public function naldi()
    {
        return view('developer.naldi');
    }
    public function rahul()
    {
        return view('developer.rahul');
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
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function show(developer $developer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function edit(developer $developer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, developer $developer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\developer  $developer
     * @return \Illuminate\Http\Response
     */
    public function destroy(developer $developer)
    {
        //
    }
}
