<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\SheetResponse;
use App\Stack;

class StackController extends Controller
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
     * Display a listing of the resource for a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserStacks()
    {
        return view('my-stacks', 
            ['stacks' => Auth::User()->stacks]
        );
    }

     /**
     * Display a Stack status
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserStackStatus(Stack $stack)
    {
        $sheets_ids = $stack->sheets->pluck('id')->toArray();
        $sheets_responses = SheetResponse::where('user_id', Auth::User()->id)->
                            whereIn('sheet_id', $sheets_ids)->get();
        
        return view('stack-status', 
            [
                'stack' => $stack,
                'responses' => $sheets_responses
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stack-management/stack-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stack = new Stack;
        $stack->name = $request->name;
        $stack->description = $request->desc;
        $stack->save();
        return $request->input('name') . $request->input('desc');
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
        return view('stack-management/stack-edit');
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
