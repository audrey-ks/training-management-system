<?php
namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use App\Models\User;
use App\Notifications\AdminLoginNotification;
use App\Notifications\AdminLogoutNotification;
use Illuminate\Support\Facades\Notification;

class SendAdminNotifications
{
    public function handleLogin(UserLoggedIn $event): void
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new AdminLoginNotification($event));
    }

    public function handleLogout(UserLoggedOut $event): void
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new AdminLogoutNotification($event));
    }
}
