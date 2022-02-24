<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getUserNotifications(){
        $notifications = Auth::user()->notifications;
        $data_array = [
            'notifications' => $notifications,
            'count' => Auth::user()->notifications()->count()
        ];
        return response()->json($data_array);
    }

    public function getUserUnreadNotifications(){
        $notifications = Auth::user()->unreadNotifications;
        $data_array = [
            'notifications' => $notifications,
            'count' => Auth::user()->unreadNotifications()->count()
        ];
        return response()->json($data_array);
    }

    public function markAsReadNotificationUser(Request $request){
        $notification = Auth::user()->notifications()->where('id', $request->input('id'))->first();
        if($notification){
            $notification->markAsRead();
            return response()->json(['success'=> 1]);
        }
    }
    public function markAllAsReadNotificationsUser(Request $request){
        $notifications = Auth::user()->unreadNotifications;
        foreach ($notifications as $notification){
            $notification->markAsRead();
        }
        return response()->json(['success'=> 1]);
    }

    public function getAdminUnreadNotifications(){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        $data_array = [
            'notifications' => $notifications,
            'count' => Auth::guard('admin')->user()->unreadNotifications()->count()
        ];
        return response()->json($data_array);
    }

    public function markAsReadNotificationAdmin(Request $request){
        $notification = Auth::guard('admin')->user()->notifications()->where('id', $request->input('id'))->first();
        if($notification){
            $notification->markAsRead();
            return response()->json(['success'=> 1]);
        }
    }
    public function markAllAsReadNotificationsAdmin(Request $request){
        $notifications = Auth::guard('admin')->user()->unreadNotifications;
        foreach ($notifications as $notification){
            $notification->markAsRead();
        }
        return response()->json(['success'=> 1]);
    }
}
