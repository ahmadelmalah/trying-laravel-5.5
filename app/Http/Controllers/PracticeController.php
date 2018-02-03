<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Stack;
use App\Sheet;
use App\SheetResponse;

class PracticeController extends Controller
{
    /**
     * Algorithm lives here
     *
     * @return \Illuminate\Http\Response
     */
    public function getNextSheet(User $user, Stack $stack)
    {
        $sheets_ids = $stack->sheets->pluck('id')->toArray();
        $sheets_responses = SheetResponse::where('user_id', Auth::User()->id)->
                            whereIn('sheet_id', $sheets_ids)
                            ->orderBy('correct', 'ASC')
                            ->orderBy('wrong', 'DESC')
                            ->inRandomOrder()
                            ->first();
        $sheet = Sheet::find($sheets_responses->sheet_id);
        return $sheet;
    }

    /**
     * Answers Checking Methods
     *
     * @return Boolean
     */
    public static function checkAnswer($response, $answer)
    {
        //trim spaces
        $response = trim($response);
        $answer = trim($answer);

        //convert both to lower
        $response = strtolower($response);
        $answer = strtolower($answer);

        return $response == $answer;
    }

    /**
     * Getting new question
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Stack $stack, Request $request)
    {
        if (null !== $request->input('sheet')){
            $sheet = Sheet::findOrFail($request->input('sheet'));
            if ($stack->id != $sheet->stack->id){
                return redirect()->route('my-stacks');   
            }
        }else{
            $sheet = $this->getNextSheet(Auth::User(), $stack);
        }

        //Revealing coditions are added here
        $reveal = false;
        if($request->input('reveal') == 'true'){
            $reveal = true;
        }

        //Initial answer
        $answer = "";
        if($reveal == true){
            $answer = $sheet->answer->answer;
        }

        return view('practice', 
            [
                'sheet' => $sheet,
                'answer' => $answer,
                'stack' => $stack,
            ]
        );
    }
}
