<?php 
//Open ob_start and session_start functions
    ob_start();
    session_start();

?>
  
<?php 

if(isset($_SESSION['user_is_logged_in'])){
    
    
}else{
    
    header("Location: logout.php");
}

?>
   

    
    <html>

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CusManager</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="js/jquery.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

        

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]
        url(https://lh3.googleusercontent.com/-7kOBhr3B2dE/AAAAAAAAAAI/AAAAAAAAAAA/AOtt-yHs4g14qqNJaJBXAcpIMv_fV9dDGw/s32-c-mo/photo.jpg)
        -->
    </head>
    
    <body style="padding-top: 30px;">            
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">

        <div class="container-fluid" >

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand navbar-light" href="customers.php" style="color: #f3f3f3">CUS <strong>MANAGER</strong></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">

                <ul class="nav navbar-nav navbar-left">
                    <li><a href=""></a></li>
                </ul>
                
             <?php if(isset($_SESSION['user_is_logged_in'])){
    
                 $fullname  = $_SESSION['user_data']['fullname'];
                 $image     = $_SESSION['user_data']['image']; 
    
                } 
    
    
    
                ?>

                <?php
                date_default_timezone_set('Europe/London'); // remove this line of code if you want to use west africa time zone which is an hour ahead of Uk time zone
                $hour      = date('H');
                $greet_User_title = "";
                if ($hour >= 23) {
                    $greetings = "Good Night";
                    $greet_User_title = $greetings;
                } elseif ($hour > 17) {
                $greetings = "Good Evening";
                $greet_User_title = $greetings;
                } elseif ($hour > 11) {
                    $greetings = "Good Afternoon";
                    $greet_User_title = $greetings;
                } elseif ($hour < 12) {
                $greetings = "Good Morning";
                $greet_User_title = $greetings;
                }
                                
                ?>
               
                <ul class="nav navbar-nav navbar-right">
                 <li class="navbar-text"><?php echo $greet_User_title. ", " .$fullname ?> </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"></b>
                        <?php echo $image ; ?></a>
                                <ul class="dropdown-menu">
                                    <li><a href="my_admin.php"><i class="fa fa-cog"></i> Account</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Sign-out</a></li>
                                </ul>
                </li>
                  
                </ul>
       
     

            </div>

        </div>

    </nav>
        
    <div class="container-fluid">
    