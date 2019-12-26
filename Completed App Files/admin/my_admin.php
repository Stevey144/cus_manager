<?php include('includes/header.php'); ?>

<?php

//Include functions
include('includes/functions.php');




?>

<?php 
/************** Fetching data from database using id ******************/

//require database class files
require('includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;

//Create a query to select all users to display in the table
   
$db->query("SELECT * FROM admin WHERE email=:email");

$email  =   $_SESSION['user_data']['email'];

$db->bindValue(':email', $email, PDO::PARAM_STR);
    
//Fetch all data and keep in a result set
$row = $db->fetchSingle();

?>



  <div class="well">
   
  <small class="pull-right"><a href="customers.php"  class="btn btn-primary"> View Customers</a> </small>
 
  <?php  $fullname = $_SESSION['user_data']['fullname'];
    
    echo '<small class="pull-left" style="color:#337ab7;">' . $fullname .'  | Veiwing / Editing</small>';
?>
    
    <h2 class="text-center">My Account</h2> <hr>
    <br>
   </div>
   
<div class="container"> 
   <div class="rows">
     
      <?php showmsg(); ?>
      
     <div class="col-md-9">
         
          <?php  if($row) { ?>
          
          
          
          <br>
           <form class="form-horizontal" role="form" method="post" action="">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name" style="color:#f3f3f3;">Fullname:</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" value="<?php echo $row['fullname'] ?>" required>
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
              <input type="password" name="password" class="form-control disabled" id="pwd" value="<?php echo $row['password'] ?>" required>
             </fieldset> 
            </div>
          </div>

         <br>
          <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-primary" href="edit_admin.php?admin_id=<?php echo $row['id'] ?>">Edit</a>
                <button type="submit" class="btn btn-danger pull-right" name="delete_form">Delete</button>
            </div>
          </div>
          
          
          
        </form>
          
  </div>
       <div class="col-md-3">
           <div style="padding: 20px;">
             <div class="thumbnail" >
              <a href="edit_admin.php?admin_id=<?php echo $row['id'] ?>">
               
                   <?php  $image = $row['image']; ?>
               
                <?php echo ' <img src="uploaded_image/' . $image . '"  style="width:150px;height:150px">'; ?> 
              </a>
              <h4 class="text-center"><?php //echo fullname of admin  ?></4>
            </div>
           </div>
       </div>
       
       <?php } ?>
       
  </div>  

</div>

<?php 
  
/************** Deleting data from database when delete button is clicked ******************/  
      
      
if(isset($_POST['delete_form'])){
    
    $admin_id = $_SESSION['user_data']['id'];
    
    keepmsg('<div class="alert alert-danger text-center">
              
              <strong>Confirm!</strong> Do you want to delete your account <br>
              <a href="#" class="btn btn-default" data-dismiss="alert" aria-label="close">No, Thanks</a><br>
              <form method="post" action="my_admin.php">
              <input type="hidden" value="' . $admin_id .'" name="id"><br>
              <input type="submit" name="delete_admin" value="Yes, Delete" class="btn btn-danger">
              </form>
            </div>');
    
}        




//If the Yes Delete (confim delete) button is click from the closable div proceed to delete


   if(isset($_POST['delete_admin'])){
       
    $id = $_POST['id'];
           
    $db->query('DELETE FROM admin WHERE id=:id');
       
    $db->bindValue(':id', $id, PDO::PARAM_INT);
       
    $run = $db->execute();
       
    if($run){
        
        redirect('logout.php');
        
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