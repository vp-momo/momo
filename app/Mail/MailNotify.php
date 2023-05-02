<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $otp = mt_rand(10000, 99999);

        Log::info($otp);

        $this->user->update([
            "remember_token" => md5($otp),
            "token_expired" => now()->addMinutes(5)
        ]);
        $from = config('app.mail.sender');
        return $this->from($from)->view('template-email', ["otp" => $otp])
            ->subject('OTP');
    }
}
