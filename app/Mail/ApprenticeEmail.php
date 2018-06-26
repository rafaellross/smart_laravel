<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApprenticeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $employees;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($employees)
     {
         $this->employees = $employees;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('raf@smartplumbingsolutions.com.au')
                          ->view('mails.apprentice_rollover')
                          ->text('mails.apprentice_rollover_plain');

    }
}
