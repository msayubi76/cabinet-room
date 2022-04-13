<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     
    public $customer_email;
    public $admin_email;
    public $is_send_email_to_admin;
    public $type;
    public $transaction;
 
    public function __construct(  $customer_email, $admin_email=null, $is_send_email_to_admin=false, $type, $transaction)
    {  
        $this->customer_email = $customer_email;
        $this->admin_email = $admin_email;
        $this->is_send_email_to_admin = $is_send_email_to_admin;
        $this->type = $type;
        $this->transaction = $transaction;
    }

     
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
