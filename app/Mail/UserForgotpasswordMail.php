<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Config;

class UserForgotpasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request_sent)
    {
        $this->user = $request_sent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = Config::get('mail.from.name');
        $from_address = Config::get('mail.from.address');
        return $this->subject('Reset your password')
                    ->view('Mail.forgot-password')
                    //->from($from_address,$from)
                    ->with([
                        'reset_link'=> route('password.reset',['token' => $this->user['token']]),
                        'name' => $this->user['name'],
                        'email' => $this->user['email']
                    ]);
    }
}
