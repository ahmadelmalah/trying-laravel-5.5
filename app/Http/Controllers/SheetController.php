<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stack;
use App\Sheet;
use App\SheetAnswer;

class SheetController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Stack $stack)
    {
        return view('stack-management/sheet-create', [
            'stack' => $stack
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Stack $stack)
    {
        //Getting answer based on its type, open text or multiple choices
        if($request->answerType == "open"){
            $answer_type = 1;
            $answer = $request->answer;
        }else if($request->answerType == "multi"){
            $answer_type = 2;
            $answer = json_encode(array_combine($request->multianswer, $request->multianswercheck));
        }

        $sheet = new Sheet();
        $sheet->stack_id = $stack->id;
        $sheet->question = $request->question;
        $sheet->save();

        $sheet_answer = new SheetAnswer();
        $sheet_answer->sheet_id = $sheet->id;
        $sheet_answer->type = $answer_type;
        $sheet_answer->answer = $answer;
        $sheet_answer->save();

        return redirect()->route('stack-edit', ['stack' => $stack->id]);
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
    public function edit(Stack $stack, Sheet $sheet)
    {
        return view('stack-management/sheet-edit', [
            'stack' => $stack,
            'sheet' => $sheet
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stack $stack, Sheet $sheet)
    {
        $sheet->question = $request->question;
        $sheet->answer->answer = $request->answer;
        $sheet->save();
        $sheet->answer->save();
        return redirect()->route('stack-edit', ['stack' => $stack->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stack $stack, Sheet $sheet)
    {
        Sheet::destroy($sheet->id);
        return redirect()->route('stack-edit', ['stack' => $stack->id]);
    }
}
