<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Stack;

class AdminController extends Controller
{
    /**
     * Display the main page in CP
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cp.index', [
            'stacks_under_dev' => Stack::where('type', 1)->count(),
            'stacks_private' => Stack::where('type', 2)->count(),
            'stacks_public' => Stack::where('type', 3)->count(),
            'users' => User::all()->count(),
        ]);
    }

    /**
     * Display User Management Page
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserManagement()
    {
        return view('cp.management.user');
    }

    /**
     * Display Stack Management Page
     *
     * @return \Illuminate\Http\Response
     */
    public function indexStackManagement()
    {
        return view('cp.management.stack');
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
        //
    }
}
