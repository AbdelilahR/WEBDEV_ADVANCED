<?php
session_start(); //start session
include("config.inc.php"); //include config file
// require_once("fetch.php");
ob_start();
 
/// require_once 'dbconnect.php';
 // this will avoid mysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 // but I strongly suggest you to use PDO or MySQLi.
 
 define('DBHOST', 'dt5.ehb.be');
 define('DBUSER', 'WDA034');
 define('DBPASS', 'Test123');
 define('DBNAME', 'WDA034');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: login.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

if (empty($_POST) === false) {
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $subject = $_POST['subject'];
    $comment = $_POST['comment'];
    
    mail('abdelilah.razzouk@student.ehb.be',$subject,$comment,'from:'.$email);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- Temporary navbar container fix -->
    <style>
    .navbar-toggler {
        z-index: 1;
    }
    
    @media (max-width: 576px) {
        nav > .container {
            width: 100%;
        }
    }
    /* Temporary fix for img-fluid sizing within the carousel */
    
    .carousel-item.active,
    .carousel-item-next,
    .carousel-item-prev {
        display: block;
    }
    </style>
    <script>
            
          function myFunction()
        {
            alert("message send");
        }
            
                              
        </script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="home.php">Start Bootstrap</a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Product</a>
                    </li>
                     <a class="nav-link" href="logout.php">
                            <?php 
                                if( !($userRow == ""))
                                {
                                      echo "Logout"; 
                                }
                                else{
                                    echo "Login"; 
                                }
                                
                            ?>
                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        
    <!-- Page Content -->
    <div class="container">

        <div class="row">

           
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

              

                <div class="row">
                    
                    <h2>Send e-mail to admin@webshop.com</h2>

                    <form action="contact.php" method="POST">
                    Name:<br>
                    <input type="text" name="name" required><br>
                    Subject:<br>
                    <input type="text" name="subject" required><br>
                    E-mail:<br>
                    <input type="text" name="mail" required><br>
                    Comment:<br>
                    <input class="textfield" type="text" name="comment" size="100" required><br><br>
                    <input class="textfield" type="submit"><br><br>    
                    
                    <input type="reset" value="Reset">
                    </form>
    
                </div>
                    
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-inverse">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
