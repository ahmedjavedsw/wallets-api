<?php 
    require_once ("walletus_php.php");
    $walletus_portal = new WalletUS_Portal();

    if(isset($_POST['invId'])){

        $invId          =   isset($_POST['invId']) ? $_POST['invId'] : '';
        $unlockCode     =   isset($_POST['unlockCode']) ? $_POST['unlockCode'] : '';
        $transactionId  =   isset($_POST['transactionId']) ? $_POST['transactionId'] : '';
        $apiKey         =   isset($_POST['apiKey']) ? $_POST['apiKey'] : '';
        $userEmail      =   isset($_POST['userEmail']) ? $_POST['userEmail'] : '';
        $amount         =   isset($_POST['amount']) ? $_POST['amount'] : '';
        $secretPass     =   isset($_POST['secretPass']) ? $_POST['secretPass'] : '';

        
        // Check key is matched with the key given to you.
        // $apiKey is key recieved from wallet us.
        // $key is key provided to you. and these both should be same.
        
        // Api Settings
        $email   = 'test@gmail.com';            // test@gmail.com (Email from wallet us)
        $key     = 'H3S7-X8R1-M7O6-Q5V0-R8P8';  //H3S7-X8R1-M7O6-Q5V0-R8P8 (API Key from wallet us)
        $secPass = 'fAtTdNRnqZhmHgB8I1j24UJcs';  // 25 digits secret call back password from wallet us

        // only will work if these 3 conditions matched
        if(($apiKey == $key) && ($userEmail == $email)  && ($secPass == $secretPass)){
            // Ok good to go.

            // Check Invoice# exist in your system and its in unpaid state + must check the orderToken code retrive from wallet us. its same code which you sent while creating a order request. sent token by you while placing the order + token retrieve from wallet us ofr invoice should be the same.
            // Ok good to go.

            // Check Invoice #exist in your system and its in unpaid state.

            // This is example query to check the invoice in system.
            $row = "SELECT Id, OrderPrice, OrderToken FROM table_name WHERE PaymentStatus = 1 AND Code = '$unlockCode' AND Id = '$invId'";
            
            // Invoice Exist
            if(isset($row->Id)){

                $unlockCodeInv  = $row->OrderToken;
                $invAmount      = $row->OrderPrice;
                
                // Check unique code which you send while request is same as of retrieve from wallet us and same for the amount.
                if(($unlockCode == $unlockCodeInv) && ($amount == $invAmount)){

                    // update invoice
                    $objDBCD14->execute("UPDATE table_name SET PaymentStatus = 2, TransactionId = '$transactionId' WHERE Id = '$invId'");

                    // Trigger Email

                    // Update Credits
                    
                }
            }
        }
    }
?>
