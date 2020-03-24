<?php 
namespace brij-fintech/brij
include_once('config.php');
 class Auth{
     
     public function __construct($appID, $appKey){
         $this->appID = appID;
         $this->appKey = appKey;
         $this->token = getToken();
     }
     
     protected function getToken(){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $tokensUrl);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
         curl_setopt($ch, CURLOPT_USERPWD, $this->appID . ':' . $this->appKey);
         
         $result = curl_exec($ch);
         if (curl_errno($ch)) {
             echo 'Error:' . curl_error($ch);
             
         }
         curl_close($ch);
         $this->token = $result['token'];
     }
 }
 
?>