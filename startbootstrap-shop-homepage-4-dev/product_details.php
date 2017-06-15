<?php
error_reporting(0); //http://stackoverflow.com/questions/26924146/how-do-i-hide-the-notice-use-of-undefined-constant


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

include("config.inc.php"); //include config file
// require_once("fetch.php");
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
?>

<!DOCTYPE html>
<html lang="en">



   <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ajax Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
       <script src="php/insert.js"></script>
       <script src="php/cart.js"></script>
       <script src="scripts.js"></script>
   <script type="text/javascript">
       
        function post()
        {
          var comment = document.getElementById("comment").value;
          var name = document.getElementById("username").value;
          if(comment && name)
          {
            $.ajax
            ({
              type: 'post',
              url: 'post_comment.php',
              data: 
              {
                 user_comm:comment,
                 user_name:name
              },
              success: function (response) 
              {
                document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
                document.getElementById("comment").value="";
                document.getElementById("username").value="";

              }
            });
          }

          return false;
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
                        <a class="nav-link" href="cart.php">Products</a>
                    </li>
                    <li class="nav-item">
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
                    </li>
                   <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            
        </div>
    </nav>
    <br><br><br><br><br><br><br>
<a href="#" class="cart-box" id="cart-info" title="View Cart">
<?php 
if(isset($_SESSION["products"])){
	echo count($_SESSION["products"]); 
}else{
	echo 0; 
}
?>
</a>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

          
            <!-- /.col-lg-3 -->

            
                  
               
                    <?php
//error_reporting(0); //http://stackoverflow.com/questions/26924146/how-do-i-hide-the-notice-use-of-undefined-constant
include("config.inc.php");

//$product_Name = $_SESSION['product_Name'];

// echo '---->   '.$product_Name;
// echo 'First --> '.$_GET[x];
// echo  'Second --> '.$product_Name;


	
$servername = "dt5.ehb.be";
                $username = "WDA034";
                $password = "Test123";
                $dbname = "WDA034";
//List products from database
 //echo $_GET[x];
$results = $mysqli_conn->query("SELECT * FROM products_list WHERE product_name='".$_GET[x]."';");
//Display fetched records as you please
    
$conn = mysqli_connect($servername,$username,$password,$dbname);
$query="SELECT product_name FROM products_list WHERE product_name ='".$_GET[x]."';";
$output=mysqli_query($conn,$query);

echo '<ul class="products-wrp">';
 //while($fetch = mysqli_fetch_assoc($output)){
while($row = $results->fetch_assoc()) {


echo '<li>';
echo'<form class="form-item">';
echo'<h4>'.$row["product_name"].'</h4>';
echo'<div><img src="images/'.$row["product_image"].'"></div>';
echo'<div>Price :'.$currency.$row["product_price"].'<div>';
echo'<div>Summary :'.$row["product_desc"].'<div>';
echo'<div class="item-box">';
echo'	<div>';
echo'    Qty :';
echo'    <select name="product_qty">';
echo'    <option value="1">1</option>';
echo'    <option value="2">2</option>';
echo'    <option value="3">3</option>';
echo'    <option value="4">4</option>';
echo'    <option value="5">5</option>';
echo '   </select>';
echo'	</div>';
echo '   <input name="product_code" type="hidden" value="'.$row["product_code"].'">';
echo  '  <button class="divbutton" type="submit">Add to cart</button>';
echo'</div>';
echo'</form>';
echo' </li>';

echo '</ul></div>';

}


//echo $products_list;


	//echo '</ul></div>';
	//echo "It's working look at the proof --> $_GET[x]";
//	}
  

?>
           
              <div>
               

                      <h2>Instant Comment System </h2>

                      <form method='post' action="" onsubmit="return post();">
                      <textarea id="comment" placeholder="Write Your Comment Here....."></textarea>
                      <br>
                      <input type="text" id="username" placeholder="Your Name">
                      <br>
                      <input type="submit" value="Post Comment">
                      </form>
            
                      <div id="all_comments">
                      <?php
                        
                        
      
                        $_SESSION['product_naam'] = $_GET[x];
                      //  echo  $_GET[x];
                        $host="dt5.ehb.be";
                        $username="WDA034";
                        $password="Test123";
                        $databasename="WDA034";

                        $connect=mysql_connect($host,$username,$password);
                        $db=mysql_select_db($databasename);
                       // echo  $_SESSION['product_naam'];
                        $query="select * from commenting WHERE product_name ='{$_GET[x]}' order by post_time desc";
                        // echo $query;
                        $comm = mysql_query($query);

                        while($row=mysql_fetch_array($comm))
                        {
                            $name=$row['name'];
                          $comment=$row['comment'];
                          $time=$row['post_time'];
                        echo' <div class="comment_div"> ';
                            
                          echo'<p class="name">Posted By:'.$row['name'].'</p>';
                          echo'<p class="comment">'.$row['comment'].'</p>	';
                          echo'<p class="time">'.$row['post_time'].'</p>';
                        echo' </div>';
                            /*
                          $name=$row['name'];
                          $comment=$row['comment'];
                          $time=$row['post_time'];
                          
                        ?>
                            
                        <div class="comment_div"> 
                            
                          <p class="name">Posted By:<?php echo $name;?></p>
                          <p class="comment"><?php echo $comment;?></p>	
                          <p class="time"><?php echo $time;?></p>
                        </div>

                        <?php
                        */
                        }
                        ?>
                          
                      </div>
                  
                              </div>
            <br>
            <div><h3> Products from the same category</h3></div>
            <br> 
            <div class="row">
                        
                <?php
                            $servername = "dt5.ehb.be";
                            $username = "WDA034";
                            $password = "Test123";
                            $dbname = "WDA034";


                              $conn = mysqli_connect($servername,$username,$password,$dbname);
                            //SELECT column FROM table ORDER BY RAND() LIMIT 1
                             $query= "SELECT * FROM products_list WHERE category = (SELECT category FROM products_list WHERE product_name ='{$_GET[x]}') AND product_name != '{$_GET[x]}' ";
                             
                             echo $query2; 
                             $output=mysqli_query($conn,$query);


                            /* Show products when category is selected */
                            //http://stackoverflow.com/questions/5285072/how-to-use-javascript-inside-a-php-echo-function
                            
                             while($fetch = mysqli_fetch_assoc($output))
                            {


                                echo' <div class="col-lg-4 col-md-6 mb-4"> ';
                                echo'   <div class="card h-100">';
                                echo'             <a href="#"><img width="253px" height="200px" src="images/'.$fetch["product_image"].'" alt=""></a>';
                                echo'            <div class="card-block">';
                                echo'                <h4 class="card-title"><a href="#">'.$fetch["product_name"].'</a></h4>';
                                echo'                <h5> € '.$fetch["product_price"].'</h5>';
                                echo'                <p class="card-text">'.$fetch["product_desc"].'</p>';
                                
                                echo'       </div>';
                                echo'            <div class="card-footer">';
                                echo'                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>';
                                echo'            </div>';
                                echo'        </div>';
                                echo'    </div>';

                             }

                           
                ?>
                    
                </div>

                  </div>  
                <!-- /.row -->

        
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
    

</body>

</html>
