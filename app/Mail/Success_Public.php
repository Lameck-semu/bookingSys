<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class Success_Public extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
*/
     public $User;
    /* *
     * @return void
     */
    public function __construct(User $user)
    {
        //
        $this->User = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bit-060-16@must.ac.mw','Facility Booking Approval')
        ->view('emails.success_public')
        ->subject('Facility booking approval');
    }
}
