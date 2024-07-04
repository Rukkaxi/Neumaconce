<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationsController extends Controller
{
    public function index() {
        Notification::where('viewed', false)->update(['viewed' => true]);
        return view('notifications');
    }

    public function fetch() {
        $notifications = Notification::whereDate('date', today())->get(['message']);
        return response()->json($notifications);
    }

    public function count() {
        $count = Notification::where('viewed', false)->count();
        return response()->json(['count' => $count]);
    }

    public function markRead() {
        Notification::where('viewed', false)->update(['viewed' => true]);
        return response()->json(['success' => true]);
    }

    public function clear() {
        Notification::whereDate('date', today())->delete();
        return response()->json(['success' => true]);
    }
}


