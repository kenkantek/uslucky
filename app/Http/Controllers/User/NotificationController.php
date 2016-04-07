<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $take = $request->per_page ?: 10;
        return $this->user->notifications()
            ->latest()->paginate($take)
            ->appends(['per_page' => $take]);
    }

    public function putIsRead(Notification $notification)
    {
        $notification->updateIsRead();
        return 1;
    }

    public function deleteNotify(Notification $notification)
    {
        $notification->delete();
        return 1;
    }
}
