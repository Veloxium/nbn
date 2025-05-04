<?php

namespace App\Providers;

use App\Listeners\RecordLoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            \App\Listeners\RecordLoginHistory::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}