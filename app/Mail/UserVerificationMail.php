<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting;
use Config;

class UserVerificationMail extends Mailable
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
        $setting = Setting::find(1);
        $from = Config::get('mail.from.name');
        $from_address = Config::get('mail.from.address');
        return $this->subject('User Activation Link')
                    ->view('Mail.user-activation')
                    ->from($from_address,$from)
                    ->with([
                        'activationLink'=> $this->user['activationLink'],
                        'name' => $this->user['name'],
                        'setting' => $setting
                    ]);
    }
}
