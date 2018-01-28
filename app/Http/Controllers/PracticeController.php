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
    public function getNextSheet($user, $stack)
    {
        $sheets_ids = $stack->sheets->pluck('id')->toArray();
        $sheets_responses = SheetResponse::where('user_id', Auth::User()->id)->
                            whereIn('sheet_id', $sheets_ids)
                            ->orderBy('correct', 'ASC')
                            ->orderBy('wrong', 'DESC')
                            ->inRandomOrder()
                            ->first();
        //return $sheets_responses->id;
        return Sheet::find($sheets_responses->sheet_id)->question;
    }

    /**
     * Getting new question
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Stack $stack)
    {
        return $this->getNextSheet(Auth::User(), $stack);
    }
}
