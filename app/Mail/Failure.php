<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;


class Failure extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
*/
     public $User;
     public $rejects;
    /* *
     * @return void
     */
    public function __construct($rejects)
    {
        //
  
        $this->rejects = $rejects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bit-060-16@must.ac.mw','Accomodation Rejection')
        ->view('emails.failure')
        ->subject('Accomodation Rejection');
    }
}
