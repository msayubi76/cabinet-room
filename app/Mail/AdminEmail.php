<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        $email_detail = array();
        $email_detail = $this->details;
       
        return    $this->subject('Mail From JDM Car Service')->view('email.admin_email', compact("email_detail")); 
    }
}
