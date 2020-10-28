<?php

namespace App\Listeners;

use App\Events\WelcomeMailEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class WelcomeMailListener
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
     * @param  WelcomeMailEvent  $event
     * @return void
     */
    public function handle(WelcomeMailEvent $event)
    {
        Mail::to($event->user)->send(new WelcomeMail($event->user));
    }
}
