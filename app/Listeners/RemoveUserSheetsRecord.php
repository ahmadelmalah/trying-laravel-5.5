<?php

namespace App\Listeners;

use App\Events\UserUnsubscripedFromStack;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\SheetResponse;

class RemoveUserSheetsRecord
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
     * @param  UserUnsubscripedFromStack  $event
     * @return void
     */
    public function handle(UserUnsubscripedFromStack $event)
    {
        foreach ($event->stack->sheets as $sheet) {
            SheetResponse::where('user_id', $event->user->id)
            ->where('sheet_id', $sheet->id)
            ->delete();
        }
    }
}
