<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class Success extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
*/
     public $User;
     public $approvals;

    /* *
     * @return void
     */
    public function __construct($approvals)
    {
        //
        $this->approvals = $approvals;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bit-060-16@must.ac.mw','Accomodation Approval')
        ->view('emails.success')
        ->subject('Accomodation approval');
    }
}
