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
            <p>{{Auth::user()->name}} has quote a new order. Order no is  {{$email_detail['transaction']->transaction_no}}</p>
        </div>
        

    </div>
    
</body>
</html>