<?php include('includes/header.php'); ?>

<?php

//Include functions
include('includes/functions.php');

?>

<?php 
/************** Fetching data from database using id ******************/

    if(isset($_GET['cus_id'])){

        $user_id   =   $_GET['cus_id'];
     }

    //require database class files
    require('includes/pdocon.php');

    //instatiating our database objects
    $db = new Pdocon;

    $db->query("SELECT * FROM users WHERE id =:id");

    $db->bindValue(':id', $user_id, PDO::PARAM_INT);

    $row = $db->fetchSingle();


?>



  <div class="well">
   
  <small class="pull-right"><a href="customers.php"> View Customers</a> </small>
 
<?php 
    
    echo '<small class="pull-left" style="color:#337ab7;">' . $_SESSION['user_data']['fullname'] . ' | Editing Customer</small>';

?>
    
    <h2 class="text-center">My Customers</h2> <hr>
    <br>
   </div> <hr>
   

    
   <div class="rows">
    <?php showmsg(); ?>
     <div class="col-md-6 col-md-offset-3">
          <?php  if($row) : ?>
          <br>
           <form class="form-horizontal" role="form" method="post" action="edit.php?cus_id=<?php echo $user_id ?>">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name" style="color:#f3f3f3;">Fullname:</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" value="<?php echo $row['fullname'] ?>" required>
            </div>
          </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="country" style="color:#f3f3f3;">Amount:</label>
            <div class="col-sm-10">
              <input type="country" name="amount" class="form-control" id="country" value="<?php echo $row['spending_amt'] ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email" style="color:#f3f3f3;">Email:</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email'] ?>" required>
            </div>
          </div>
          <div class="form-group ">
            <label class="control-label col-sm-2" for="pwd" style="color:#f3f3f3;">Password:</label>
            <div class="col-sm-10">
             <fieldset disabled> 
              <input type="password" name="password" class="form-control disabled" id="pwd" placeholder="Cannot Change Password" value="<?php echo $row['password'] ?>" required>
             </fieldset> 
            </div>
          </div>

          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-primary" name="update_customer" value="Update">
              <button type="submit" class="btn btn-danger pull-right" name="delete_customer">Delete</button>
            </div>
          </div>
          
          <?php endif ;  ?>
          
        </form>
          
  </div>
</div>  

<?php 
/************** Update data to database using id ******************/  
if(isset($_POST['update_customer'])){
    
    $raw_name           =   cleandata($_POST['name']);
    $raw_amount         =   cleandata($_POST['amount']);
    $raw_email          =   cleandata($_POST['email']);
  
    
    $c_name             =   sanitize($raw_name);
    $c_amount           =   valint($raw_amount);
    $c_email            =   valemail($raw_email);
    
    
    $db->query('UPDATE users SET fullname=:fullname, email=:email, spending_amt=:amount WHERE id=:id');
    
    $db->bindValue(':id',$user_id , PDO::PARAM_INT);
    $db->bindValue(':fullname',$c_name , PDO::PARAM_STR);
    $db->bindValue(':email',$c_email , PDO::PARAM_STR);
    $db->bindValue(':amount',$c_amount , PDO::PARAM_INT);
    
    
    $run_update = $db->execute();
    
    if($run_update){
        
        redirect('customers.php');
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong> Customer updated successfully.
                </div>');
        
        
    }else{
        
        redirect('customers.php');
        
        keepmsg('<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong> Customer Could not be updated.
                </div>');
        
    }
    
}


/************** Delete data from database using id ******************/ 

if(isset($_POST['delete_customer'])){
    
   
    
    keepmsg('<div class="alert alert-danger text-center">
              
              <strong>Confirm!</strong> Do you want to delete your account <br>
              <a href="#" class="btn btn-default" data-dismiss="alert" aria-label="close">No, Thanks</a><br>
              <form method="post" action="edit.php">
              <input type="hidden" value="' . $user_id .'" name="id"><br>
              <input type="submit" name="delete_user" value="Yes, Delete" class="btn btn-danger">
              </form>
            </div>');
    
}        




//If the Yes Delete (confim delete) button is click from the closable div proceed to delete


   if(isset($_POST['delete_user'])){
       
    $id = $_POST['id'];
           
    $db->query('DELETE FROM users WHERE id=:id');
       
    $db->bindValue(':id', $id, PDO::PARAM_INT);
       
    $run = $db->execute();
       
    if($run){
        
        redirect('customers.php');
        
        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry </strong>User successfully deleted. 
                </div>');
        
    }else{
        
         keepmsg('<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Sorry </strong>User with ID ' . $id . ' Could not be deleted 
                </div>');
    }
       
       
   }


    
      

        
      
?>


</div>
 
</div>
  
</div>
<?php include('includes/footer.php'); ?>