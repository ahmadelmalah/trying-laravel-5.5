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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Algorithm lives here
     *
     * @return \Illuminate\Http\Response
     */
    public static function getNextSheet(User $user, Stack $stack)
    {
        $sheets_ids = $stack->sheets->pluck('id')->toArray();
        $sheets_responses = SheetResponse::where('user_id', Auth::User()->id)->
                            whereIn('sheet_id', $sheets_ids)
                            ->orderByRaw('correct + reveal', 'ASC')
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
            SheetResponse::where('user_id', Auth::User()->id)
                        ->where('sheet_id', $request->get('sheet'))
                        ->increment('reveal');
            $reveal = true;
        }

        //Sending answer's type, and answer itself if revealed
        $answer_type = $sheet->answer->type;
        $answer = ""; //can be anything based on type, and reveal
        //Open Text
        if($answer_type == 1){ 
            if($reveal == true){
                $answer = $sheet->answer->answer;
            }
        //Multiple Options
        }elseif($answer_type == 2){
            $answer = json_decode($sheet->answer->answer, true);
            if($reveal == true){ 
                //
            }else{
                //Hiding answers
                $answer = array_map(function($name){return null;}, $answer);
            }
        }

        return view('practice.index', 
            [
                'sheet' => $sheet,
                'answer_type' => $answer_type,
                'answer' => $answer,
                'stack' => $stack,
                'reveal' => $reveal,
                'percentage' => StackController::getPercentage(Auth::User(), $stack)
            ]
        );
    }

    /**
     * Posting Answer
     *
     * @return \Illuminate\Http\Response
     */
    public function postAnswer(Stack $stack, Request $request)
    {
        $userResponse =  $request->get('UserResponse');
        $correctAnswer = Sheet::find($request->get('sheetID'))->answer->answer;

        if ($this::checkAnswer($userResponse, $correctAnswer) == true){
            SheetResponse::where('user_id', Auth::User()->id)
                        ->where('sheet_id', $request->get('sheetID'))
                        ->increment('correct');
        }else{
            SheetResponse::where('user_id', Auth::User()->id)
                        ->where('sheet_id', $request->get('sheetID'))
                        ->increment('wrong');
        }
        return redirect()->route('practice', ['stack' => $stack->id]);
    }
}
