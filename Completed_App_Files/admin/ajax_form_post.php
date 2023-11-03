<?php include('includes/header.php'); ?>


<?php

//Include functions
include('includes/functions.php');


?>

<?php 
/************** Fetching all data from database ******************/


//require database class files
require('includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;




if(isset($_POST['c_id'])){
    
$id = $_POST['c_id'];     
    
$raw_amount         =   cleandata($_POST['salary']);

$c_amount           =   valint($raw_amount);
    
$db->query("UPDATE users SET spending_amt=:amount WHERE id=:id");
    
$db->bindValue(':id', $id, PDO::PARAM_INT);
$db->bindValue(':amount', $c_amount, PDO::PARAM_INT);
    
$row = $db->execute();
  

    if($row){

         echo "<p class='bg-success text-center' style='font-weight:bold;'>User Updated </p>";
         echo '<a type="submit" href="reports.php?cus_id='.$id.'" class="btn btn-primary" style="margin-left:150px;" value="OK" name="reload">OK</a';

     }

}


?>