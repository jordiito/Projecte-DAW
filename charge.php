<?php
    include_once "stripe-php/init.php";
    spl_autoload_register(function ($classe) {
        $folders = array(
            'model',
            'view',
            'controller'
        );
        foreach ($folders as $folder) {
            $path = "class/$folder/$classe.php";
            if (file_exists($path)) {
                require_once ($path);
                return;
            }
        }
    });
    \Stripe\Stripe::setApiKey("sk_test_51L88NdJcxF7HsahsTJg6k3eTCwuLXMas7SS5gGldbXy4zpjBGowqWGddNV39PoP0VcGAiB8JZGaf94EOJwA9pWqJ00Yf0QwjW8");
    $token=$_POST['stripeToken'];
    
    $charge=\Stripe\Charge::create([
        'amount'=>"$total",
        'currency'=>'eur',
        'description'=>'Pago a ecommerce',
        'source'=>$token
    ]);
    echo "<pre>";
    var_dump($charge);
    echo "</pre>";
?>