<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class RecordLoginHistory
{
    public function __construct(
        protected Request $request
    ) {}

    public function handle(Login $event)
    {
        $event->user->loginHistories()->create([
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
            'login_at' => now(),
        ]);
    }
}