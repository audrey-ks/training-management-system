<?php
namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoggedOut
{
    use Dispatchable, SerializesModels;

    public $user;
    public $ip;
    public $userAgent;

    public function __construct(User $user, string $ip, string $userAgent)
    {
        $this->user      = $user;
        $this->ip        = $ip;
        $this->userAgent = $userAgent;
    }
}
