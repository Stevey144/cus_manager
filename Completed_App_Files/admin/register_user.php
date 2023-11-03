<?php include('includes/header.php'); ?>


<?php

//Include functions
include('includes/functions.php');



?>
 
 
 
<?php
/************** Register new customer ******************/


//require database class files
require('includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;


//Collect and clean values from the form
if(isset($_POST['submit_user'])){
    
    $raw_name           =   cleandata($_POST['name']);
    $raw_amount         =   cleandata($_POST['amount']);
    $raw_email          =   cleandata($_POST['email']);
    $raw_password       =   cleandata($_POST['password']);
    
    
    $c_name             =   sanitize($raw_name);
    $c_amount           =   valint($raw_amount);
    $c_email            =   valemail($raw_email);
    $c_password         =   sanitize($raw_password);
    
    $hashed_pass        =   hashpassword($c_password);
    
    $db->query('SELECT * FROM  users WHERE email=:email');
    
    $db->bindValue(':email', $c_email, PDO::PARAM_STR);
    
     $row = $db->fetchSingle();
    
    if($row){
        
        redirect('customers.php');
        
        keepmsg('<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry!</strong> Customer Already Exist. Please Register Again
                </div>');
        
    }else{
    
    $db->query('INSERT INTO users (id, email, password, fullname, spending_amt) VALUES (NULL, :email, :password, :fullname, :spending_amt)');

    $db->bindValue(':email', $c_name, PDO::PARAM_STR);
    $db->bindValue(':password',$hashed_pass , PDO::PARAM_STR);
    $db->bindValue(':fullname',    $c_name , PDO::PARAM_STR);
    $db->bindValue(':spending_amt', $c_amount, PDO::PARAM_INT);

    $run_user = $db->execute();


    if($run_user){
        
        redirect('customers.php');

        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong> Customer registered successfully.
                </div>');

    }else{
        
         keepmsg('<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry!</strong> Customer could not be registered.
                </div>');
    }    

  }

}


?>

  
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class="pull-right" style="color:#777"> Adding Customer in Database</p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
           <form class="form-horizontal" role="form" method="post" action="register_user.php">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name"></label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" placeholder="Enter Full Name" required>
            </div>
          </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="salary"></label>
            <div class="col-sm-10">
              <input type="text" name="amount" class="form-control" id="country" placeholder="Enter Amount" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10"> 
              <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter Password" required>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label><input type="checkbox" required> Accept</label>
              </div>
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary pull-right" name="submit_user">Register</button>
              <a class="pull-left btn btn-danger" href="customers.php"> Cancel</a>
            </div>
          </div>
</form>
          
  </div>
</div>
          
  </div>
</div>
  
<?php include('includes/footer.php'); ?>  