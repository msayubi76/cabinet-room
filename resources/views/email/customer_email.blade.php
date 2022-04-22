<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .container{
            margin: 20px;
            width: 100%;
            max-width: 100%;
            padding: 20px;
        }
         
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <h3>Alert email from JDM.</h3>
            @if ($email_detail['type'] == 'quote')
                <p>Your order has been quoted. Your order no is {{$email_detail['transaction']->transaction_no}} </p>

                @elseif ($email_detail['type'] == 'order_accepted')
                <p>Your order has been accepted. Order no is {{$email_detail['transaction']->transaction_no}} . Total amount against this order is {{$email_detail['transaction']->total.' $'}} .   </p> 
                
                @elseif ($email_detail['type'] == 'upload_document')
                <p>Documents against {{$email_detail['transaction']->transaction_no}} has been uploaded. Click on below link or visit your customer dashboard.  </p>
              
                <a  class="" href="{{url('documents/'.encrypt($email_detail['transaction']->id))}}" title="Preview"  target="_blank" >View Documents</a>
                
                @elseif ($email_detail['type'] == 'shipping_detail')
                <p>Shipping detai against {{$email_detail['transaction']->transaction_no}} has been added. Click on below link or visit your customer dashboard.  </p>
              
                <a  class="" href="{{url('order/detail/'.encrypt($email_detail['transaction']->id))}}" title="Preview"  target="_blank" >View Detail</a>
                
                @elseif ($email_detail['type'] == 'shipped')
                <p>Your order has been shipped. Order no is {{$email_detail['transaction']->transaction_no}}. Click on below link or visit your customer dashboard.  </p>
              
                <a  class="" href="{{url('order/detail/'.encrypt($email_detail['transaction']->id))}}" title="Preview"  target="_blank" >View Detail</a>
                @elseif ( $email_detail['type'] == 'registrition')
                <p>Your account has been created.Your customer id is
                     {{$email_detail['transaction']->customer_id}}. Click on below link or visit your customer dashboard.  </p>
              
                <a  href="{{url('dashboard')}}" title="Preview"  target="_blank" >Click</a>
            @endif
 
        </div>

    </div>
    
</body>
</html>