<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Mail\AdminEmail;
use App\Mail\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailListener
{
    
    public function __construct()
    {
        //
    }
 
    public function handle(SendEmailEvent $event)
    {  
        $details = [
            'type' => $event->type,
            'transaction' => $event->transaction,
        ];
        
        if($event->is_send_email_to_admin):
            Mail::to($event->admin_email)->send(new AdminEmail($details));
        endif;
            Mail::to($event->customer_email)->send(new SendEmail($details));
    }
}
