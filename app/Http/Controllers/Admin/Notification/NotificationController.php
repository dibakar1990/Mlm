<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;

class NotificationController extends Controller
{
    public function index()
    {
        
        $notifications = auth()->user()->notifications;
        return view('backend.notification.index', compact(
            'notifications'
        ));
    }

    public function destroy($id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();
        return redirect()->route('admin.notifications.index')->with(['success' => "Item(s) deleted successfully"]);
    }

    public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();
 
        return response()->noContent();
    }
}
