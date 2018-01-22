<?php

namespace App\Listeners;

use App\Events\UsersubscripedToStack;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //
        echo "I caught you, huh!!!";
        return "I caught you, huh!";
    }
}
