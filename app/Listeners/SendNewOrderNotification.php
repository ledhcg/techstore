<?php

namespace App\Listeners;

use App\Models\Admin;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;

class SendNewOrderNotification
{
    public function handle($event){
        $admins = Admin::find(1);
        Notification::send($admins, new NewOrderNotification($event->order_tracking));
    }
}
