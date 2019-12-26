<?php include('includes/header.php'); ?>


<?php

//Include functions
include('includes/functions.php');


?>
<?php

//Get ID and pass it on to ajax
$id = $_GET['cus_id'];

?>
    
    
<script>

$(document).ready(function(){
    
    setInterval(function(){ display_report_menu(); }, 2000);
    setInterval(function(){ display_customer_info(); }, 4000);
    
    function display_report_menu(){
        
        $.ajax({
            
            url: 'ajax_report_menu.php?cid=<?php echo $id; ?>',
            type: 'POST',
            success: function(show_report){
                
                if(show_report){
                    
                    $("#report_menu").html(show_report);
                }
            }
            
        });
        
    }
    
    function display_customer_info(){
        
        
        $.get("ajax_show_customer.php?cid=<?php echo $id; ?>", function(show_customer){ $("#customerinfo").html(show_customer)});
        
    }
    

});
    
</script>
    
    


    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                           <?php echo $fullname;//Collect the admin's name and put it in there using the session super global?> | You are Admin
                        </h3>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-envelope"></i><a href="msg-customer.php?cid=<?php echo $id; ?>" class="btn btn-primary" style="padding:2px;">Message Customer</a>  
                            </li>
                            <small class="pull-right"><a href="customers.php" class="btn btn-primary" style="padding:2px;"> View Customers </a> </small>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
                <div class="row" id="report_menu">
                 
              
                </div> 

                <div class="row">
                    
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-money fa-fw"></i> Customer Information</h3>
                            </div>
                            <div id="customerinfo" class="panel-body" style="background-color:lightgrey;">
                                 <!-- Customer information from Ajax Here -->
                              
                                <div class="text-right">
                                    <a href="#"><i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-money fa-fw"></i> Transactions Details</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Order Date</th>
                                               
                                                <th>Amount (USD)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>3326</td>
                                                <td>10/21/2013</td>
                                         
                                                <td>$321.33</td>
                                            </tr>
                                            <tr>
                                                <td>3325</td>
                                                <td>10/21/2013</td>
                                           
                                                <td>$234.34</td>
                                            </tr>
                                            <tr>
                                                <td>3324</td>
                                                <td>10/21/2013</td>
                                         
                                                <td>$724.17</td>
                                            </tr>
                                            <tr>
                                                <td>3323</td>
                                                <td>10/21/2013</td>
                                        
                                                <td>$23.71</td>
                                            </tr>
                                      
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <a href="#"><i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-money fa-fw"></i> Update Spending Amount</h3>
                            </div>
                            <div id="alert_success" class="panel-body">
   
                                          <br>
                                          
                                            <form method="post" class="form-horizontal" role="form" action="ajax_form_post.php" id="updatedata">
                                                  <div class="form-group">
                                                        <label class="control-label col-sm-2" for="salary" style="color:#777;">Amt</label>
                                                        <div class="col-sm-10">
                                                          <input type="text" name="salary" class="form-control" id="salary" placeholder="Update Amount" required>
                                                        </div>
                                                  </div>
                                                  <div class="form-group">
                                                        <div class="col-sm-10">
                                                          <input type="hidden" name="c_id" class="form-control" id="user_id" value="<?php echo $id; ?>" required>
                                                        </div>
                                                  </div>

                                                  <div class="form-group"> 
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                      <input type="submit" class="btn btn-primary" name="update_customer" value="submit"  id="submitdata">
                                                    </div>
                                                  </div>
                                            </form>
                                            
                                <div class="text-right">
                                    <a href="#"><i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <script>
            /************** Updating data to database using id ******************/ 
                    
                    $(document).ready(function(){ 
                        
                        $("#updatedata").submit(function(stop_default){ 
                            
                            stop_default.preventDefault();
                            
                            var url     = $(this).attr("action");
                            
                            var data    = $(this).serialize();
             
                            $.post(url, data, function(confirm){
                                
                                $("#alert_success").html(confirm);
                            });
                            
                            
                            $("#updatedata")[0].reset();
                            
                                                                      
                        });

                       

                    });

                </script>
 
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include('includes/footer.php'); ?>