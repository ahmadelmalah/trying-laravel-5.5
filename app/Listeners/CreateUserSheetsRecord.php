<?php

namespace App\Listeners;

use App\Events\UsersubscripedToStack;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\SheetResponse;

class CreateUserSheetsRecord
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UsersubscripedToStack  $event
     * @return void
     */
    public function handle(UsersubscripedToStack $event)
    {
        foreach ($event->stack->sheets as $sheet) {
            $sheet_response = new SheetResponse;
            $sheet_response->user_id=$event->user->id;
            $sheet_response->sheet_id=$sheet->id;;
            $sheet_response->save();
        }
    }
}
