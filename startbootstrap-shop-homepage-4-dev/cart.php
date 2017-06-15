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
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ajax Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    
    <script src="php/cart.js"></script>
    <script src="php/filter.js"></script>
    
</head>
<body>
<div align="center">
<h3>Ajax Shopping Cart Example</h3>
</div>
 <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="home.php">Start Bootstrap</a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Products</a>
                    </li>
                    <li class="nav-item">
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
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
<a href="#" class="cart-box" id="cart-info" title="View Cart">
<?php 
if(isset($_SESSION["products"])){
	echo count($_SESSION["products"]); 
}else{
	echo 0; 
}
?>
</a>

     <div class="container">

        <div class="row">
            <div class="col-lg-3">

                <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <select id="fetchval" name="fetchby" >
                        
                        <option select="none" value="<?php echo "SELECT * FROM products_list;" ?>">All</option>
                        <option value="<?php echo "SELECT * FROM products_list WHERE category = 'Action';" ?>">Action</option>
                        <option value="<?php echo "SELECT * FROM products_list WHERE category = 'Horror';" ?>">Horror</option>
                        <option value="<?php echo "SELECT * FROM products_list WHERE category = 'Comedy';" ?>">Comedy</option>
                        <option value="<?php echo "SELECT * FROM products_list WHERE category = 'Fantasy';" ?>">Fantasy</option>
                        <option value="<?php echo "SELECT * FROM products_list WHERE category = 'Thriller';" ?>">Thriller</option>
                      
                    </select>
                </div>
            </div>
                 <div id="table-container">
                      
                </div>
<div class="shopping-cart-box">
<a href="#" class="close-shopping-cart-box" >Close</a>
<h3>Your Shopping Cart</h3>
    <div id="shopping-cart-results">
    </div>
</div>

<div id="test">
<?php
    /*
$servername = "dt5.ehb.be";
                $username = "WDA034";
                $password = "Test123";
                $dbname = "WDA034";
//List products from database
$results = $mysqli_conn->query("SELECT * FROM products_list");
//Display fetched records as you please
    
$conn = mysqli_connect($servername,$username,$password,$dbname);
                  $query="SELECT * FROM products_list";
                  $output=mysqli_query($conn,$query);

echo '<ul class="products-wrp">';
 while($fetch = mysqli_fetch_assoc($output)){
//while($row = $results->fetch_assoc()) {


echo '<li>';
echo'<form class="form-item">';
echo'<h4>'.$fetch["product_name"].'</h4>';
echo'<div><img src="images/'.$fetch["product_image"].'"></div>';
echo'<div>Price :'.$currency.$fetch["product_price"].'<div>';
echo'<div class="item-box">';
   echo '<script src="php/cart.js"></script>';
	
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
	
	
	
echo '   <input name="product_code" type="hidden" value="'.$fetch["product_code"].'">';
echo  '  <button type="submit">Add to cart</button>';
echo'</div>';
echo'</form>';
echo' </li>';


}
            
echo '</ul></div>';

//echo $products_list;
*/
?>
</div>
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
         
</body>
</html>