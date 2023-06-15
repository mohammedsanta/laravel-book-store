<?php

namespace App\Listeners;

use App\Events\UserLogin;
use App\Models\UserLastLogin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LastLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLogin $event): void
    {

        UserLastLogin::create([
            'user_id' => $event->user->id,
            'last_login' => date('Y-m-d H-m-s')
        ]);
    }
}
