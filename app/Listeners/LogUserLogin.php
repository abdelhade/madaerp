<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginSession;

class LogUserLogin
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
    public function handle(Login $event): void
    {
        LoginSession::create([
            'user_id'    => $event->user->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'device'     => request()->header('User-Agent'), // ممكن تحللها أكتر لو عايز
            'login_at'   => now(),
            'session_id' => session()->getId(),
        ]);
    }
}
