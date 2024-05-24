<?php 
    require_once ("walletus_php.php");
    $walletus_portal = new WalletUS_Portal();

    if(isset($_REQUEST['invId'])){

        $invId          =   isset($_REQUEST['invId']) ? $_REQUEST['invId'] : '';
        $unlockCode     =   isset($_REQUEST['unlockCode']) ? $_REQUEST['unlockCode'] : '';
        $transactionId  =   isset($_REQUEST['transactionId']) ? $_REQUEST['transactionId'] : '';
        $apiKey         =   isset($_REQUEST['apiKey']) ? $_REQUEST['apiKey'] : '';
        $userEmail      =   isset($_REQUEST['userEmail']) ? $_REQUEST['userEmail'] : '';
        $amount         =   isset($_REQUEST['amount']) ? $_REQUEST['amount'] : '';

        // Check key is matched with the key given to you.
        // $apiKey is key recieved from wallet us.
        // $key is key provided to you. and these both should be same.
        
        // Api Settings
        $email   = 'test@gmail.com';            // test@gmail.com (Email from wallet us)
        $key     = 'H3S7-X8R1-M7O6-Q5V0-R8P8';  //H3S7-X8R1-M7O6-Q5V0-R8P8 (API Key from wallet us)

        if(($apiKey == $key) && ($userEmail == $email)){
            // Ok good to go.

            // Check Invoice #exist in your system and its in unpaid state.

            // This is example query to check the invoice in system.
            $row = "SELECT Id, OrderPrice, OrderToken FROM table_name WHERE PaymentStatus = 1 AND Id = '$invId'";
            
            // Invoice Exist
            if(isset($row->Id)){

                $unlockCodeInv  = $row->OrderToken;
                $invAmount      = $row->OrderPrice;
                
                // Check unique code which you send while request is same as of retrieve from wallet us and same for the amount.
                if(($unlockCode == $unlockCodeInv) && ($amount == $invAmount)){

                    // update invoice
                    $objDBCD14->execute("UPDATE table_name SET PaymentStatus = 2, TransactionId = '$transactionId' WHERE Id = '$invId'");

                }
            }
        }
    }
?>
