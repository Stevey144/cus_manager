<?php

//function to trim values
function cleandata($value){
    
   return trim($value);
}



//function to sanitize value for string
function sanitize($raw_value){                                         
    
    return filter_var($raw_value, FILTER_SANITIZE_STRING);
}



//function to validate value for email
function valemail($raw_email){
    
    return filter_var($raw_email, FILTER_VALIDATE_EMAIL);
    
}

//function to validate value for integer
function valint($raw_int){
    
    return filter_var($raw_int, FILTER_VALIDATE_INT);
    
}


//function to redirect
function redirect($page){
    
    header("Location: {$page}");
    
}



//function to keep error and success messages in a session 
function keepmsg($message){                                    
    
    if(empty($message)){
        
        $message = "";
    }else{
        
          $_SESSION['msg']    =   $message;
        
    }

    
}


//function to display the stored message in the session super global
function showmsg(){
    
    if(isset($_SESSION['msg'])){
        
        echo $_SESSION['msg'];
            
        unset($_SESSION['msg']);
        
    }
    
    
}



//Create function to hash password using md5
function hashpassword($clean_password){          
    
    return md5($clean_password);
    
}


?>



