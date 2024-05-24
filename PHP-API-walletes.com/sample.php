<?php 
    require_once ("walletus_php.php");
    $walletus_portal = new WalletUS_Portal();

    // Api Settings
    $email      = 'test@gmail.com'; // Email of wallet us
    $apiKey     = 'H3S7-X8R1-M7O6-Q5V0-R8P8'; //API key given by wallet us

    // Customer Details
    $userName   = 'Developer';
    $userEmail  = 'developer@gmail.com'; // Logged In Customer Email
    $amount     = '20.00';  //AMOUNT IN FORMAT, 50.20
    $invoiceId  = rand(); // rand() is for testing purpose, This should be your system generated Invoice Id
    $unique_code	= date('ymdhis'); // date(ymdhis) is for testing purpose, This should be your system generated 8 digits unique Code and also this should be saved with in payment table.
    $successPaymentUrl    = 'www.testing.com/invoice/success'; // This will be URL where user will redirect after payment
    $cancelPaymentUrl     = 'www.testing.com/invoice/failure'; // This will be URL where user will redirect after cancellation of payment

    $walletus_portal->set_access($email, $apiKey);
    $walletus_portal->set_order($userEmail, $userName,  $amount, $invoiceId, $successPaymentUrl, $cancelPaymentUrl);

    $new_payment = $walletus_portal->generate_link();

    // If $new_payment->status == 1 means invoice successfully created.
    if($new_payment->status == 1){
        echo "<script>window.location = '".$new_payment->redirectUrl."'</script>";
        exit;
    }	

?>
