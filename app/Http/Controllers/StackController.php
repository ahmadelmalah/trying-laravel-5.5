<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Events\UsersubscripedToStack;
use App\Events\UserUnsubscripedFromStack;

use DB;
use App\SheetResponse;
use App\Stack;
use App\Sheet;
use App\User;
use App\StackUser;

class StackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        ['stacks' => Stack::where('created_by', Auth::User()->id)->get()]
        );
    }

    /**
     * Display a listing of public stacks
     *
     * @return \Illuminate\Http\Response
     */
    public function marketplace()
    {
        return view('marketplace', 
            ['stacks' => Stack::where('type_id', 3)->get()]
        );
    }

    /**
     * Display a listing of User subscriptions
     *
     * @return \Illuminate\Http\Response
     */
    public function subscriptions()
    {
        return view('subscriptions', 
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
                'responses' => $sheets_responses,
                'percentage' => $this->getPercentage(Auth::User(), $stack)
            ]
        );
    }

    /**
     * Get stack percentage
     *
     * @return \Illuminate\Http\Response
     */
    public static function getPercentage(User $user, Stack $stack)
    {
        $sheets_ids = $stack->sheets->pluck('id')->toArray();
        $sheets_ids = '(' . implode(",", $sheets_ids) . ')';
        $sql = "SELECT count(id) as total, sum(case when correct > 0 then 1 else 0 end) as correct 
                FROM `sheets_responses` 
                WHERE `user_id` = {$user->id} AND `sheet_id` IN {$sheets_ids}";
        $results = DB::select($sql);
        return round(100*$results[0]->correct/$results[0]->total);
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
        $stack->type_id = 1; // Under Development
        $stack->price = $request->price;
        $stack->created_by = Auth::User()->id; 
        $stack->save();
        return redirect()->route('stack-edit', ['stack' => $stack->id]);
    }

    /**
     * Publishing a stack
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Stack $stack)
    {
        //Validation
        if (count($stack->sheets) < 3){
            return redirect()->route('stack-edit', ['stack' => $stack->id])
                    ->with('error', 'Stack needs at least 3 sheets');
        }
        //Publishing
        $stack->type_id = 2;
        $stack->save();
        //Assigning the stack to the user and fire the event
        DB::table('stack_user')->insert(['user_id' => Auth::User()->id,'stack_id' => $stack->id]);
        event(new UsersubscripedToStack(Auth::User(), $stack));


        return redirect()->route('my-stacks');
    }

    /**
     * Making a stack public
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makepublic(Request $request, Stack $stack)
    {
        $stack->type_id = 3;
        $stack->save();

        return redirect()->route('my-stacks');
    }

    /**
     * Subscribe to a stack
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request, Stack $stack)
    {
        //Assigning the stack to the user and fire the event
        DB::table('stack_user')->insert(['user_id' => Auth::User()->id,'stack_id' => $stack->id]);
        event(new UsersubscripedToStack(Auth::User(), $stack));
        return redirect()->route('my-stacks');
    }

    /**
     * Unsubscribe from a stack
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request, Stack $stack)
    {
        //removing the stack from the user and fire the event
        StackUser::where('user_id', Auth()->User()->id)
        ->where('stack_id', $stack->id)
        ->delete();
        event(new UserUnsubscripedFromStack(Auth::User(), $stack));
        return redirect()->route('my-stacks');
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
    public function edit(Stack $stack)
    {
        $sheets = Sheet::where('stack_id', $stack->id)->get();
        
        return view('stack-management/stack-edit', 
            [
                'stack' => $stack,
                'sheets' => $sheets
            ]
        );
    }

     /**
     * clearing all answers from a stack for the current user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clear(Stack $stack)
    {
        $sheets_ids = $stack->sheets->pluck('id')->toArray();
        $sheets_responses = SheetResponse::whereIn('sheet_id', $sheets_ids)
                            ->update([
                                'correct' => 0,
                                'reveal' => 0,
                                'wrong' => 0
                            ]);
        return redirect()->route('stack-status', ['stack' => $stack->id]);
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
    public function destroy(Stack $stack)
    {
        Stack::destroy($stack->id);
        return back();
    }
}
