<?php
namespace App\Notifications;

use App\Events\UserLoggedOut;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminLogoutNotification extends Notification
{
    use Queueable;

    public $event;

    public function __construct(UserLoggedOut $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $user = $this->event->user;
        return (new MailMessage)
            ->subject('Logout Alert: ' . $user->name . ' (' . ucfirst($user->role) . ')')
            ->line("**{$user->name} ({ucfirst($user->role)}) just logged out.**")
            ->line('Email: ' . $user->email)
            ->line('IP: ' . $this->event->ip)
            ->line('User Agent: ' . $this->event->userAgent)
            ->line('Time: ' . now()->format('Y-m-d H:i:s'));
    }
}
