<?php
/*
*Plugin name: Postmarker
*/

require_once(ABSPATH .'/vendor/autoload.php');
use Postmark\PostmarkClient;    

 if(!function_exists(wp_mail)){
    function wp_mail($to, $subject, $message, $headers){
        
        $client = new PostmarkClient("5ab4c8ed-a763-4e70-a70b-7f364e28a9b4");
        
        // $sendResult = $client->sendEmail(
        //   "glenn@markscott.co.nz", 
        //   "glennjamesforrest@gmail.com", 
        //   "Testing an email send from WoodPress",
        //   "Hey there, this was sent from my WooCommerce site when I opened up a sweet page!");  
          
         
            
            // ob_start();
            //   include_once('email_template.php');
            // $email_template =  ob_get_clean();
        
          
          
        $message2 = ['To' => $to,
             'Cc' => "glennjamesforrest@gmail.com",
             'Subject' => $subject,
             'HtmlBody' =>$message,
             'From' => "glenn@markscott.co.nz"];  
        // Pass the messages as an array to the `sendEmailBatch` function.
        $responses = $client->sendEmailBatch([$message2]);
    }
 }