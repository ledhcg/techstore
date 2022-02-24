<?php

namespace App\Listeners;

use App\Events\UpdateChange;
use App\Models\User;
use App\Notifications\ChangeOrderStatusNotification;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendChangeOrderStatusNotification
{
    public function handle($event)
    {
        $user = User::find($event->user_id);
        Notification::send($user, new ChangeOrderStatusNotification($event->user_id, $event->order_tracking, $event->status));
    }
}
