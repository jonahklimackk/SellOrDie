<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $loginUrl;
    public $createAdUrl;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->loginUrl = url('/login');
        $this->createAdUrl = url('/ads');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {


        
        return $this
        ->subject('Welcome to SellOrDie! Ready to enter your first ad?')
        ->markdown('emails.welcome_new_user')
        ->with([
            'user'        => $this->user,
            'loginUrl'    => $this->loginUrl,
            'createAdUrl' => $this->createAdUrl,
        ]);
    }
}