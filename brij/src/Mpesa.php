<?PHP
namespace brij-fintech/brij
include_once('config.php');

class MpesaServices extends Auth{
    
    public function mpesaToAcc($amount, $sender, $phoneNumber, $description, $env){
        /*
        this method uses MPESA API to send cash from your app user to your account in brij.
        **Args:*"
        -amount (int) amount to be sent
        -sender (str) the unique id of your user
        -description (str) reason for sending
        -sender_phone (str) phone number sending the cash starting with the country code without the plus sign
        
        **returns:**
        
        */
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $mpesaToAccUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"amount\":".$amount.",\"sender\":".$sender.",\"phone_number\":".$phoneNumber.",\"description\":".$description.",\"env\":".env."}");
        
        $headers = array();
        $headers[] = 'Authorization: Bearer '.$this->token;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
    
    public function mpesaToEscrow($amount, $sender, $recepient, $phoneNumber, $description, $env){
        /*
        this method uses MPESA API to escrow cash between your app users, using your Brij account as the escrow account
        ***Args***
        -amount (string) 
        -sender (string) sender email address or Mpesa phone number starting with the country code without the plus sign
        -recepient (string) recepient email address or Mpesa phone number starting with the country code without the plus sign
        -description (string) reason for sending
        */
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $mpesaToEscrowUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"amount\":".$amount.",\"sender\":".$sender.", \"recepient\":".$recepient.", phone_number\":".$phoneNumber.",\"description\":".$description.",\"env\":".$env."}");
        
        $headers = array();
        $headers[] = 'Authorization: Bearer TOKEN';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
    
}

?>