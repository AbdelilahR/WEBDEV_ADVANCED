<?php
  
session_start();

$servername = "dt5.ehb.be";
$username = "WDA034";
$password = "Test123";
$dbname = "WDA034";


  $conn = mysqli_connect($servername,$username,$password,$dbname);
 
 $request=$_POST['request'];
 $query=$request;
   
  
  $output=mysqli_query($conn,$query);


/* Show products when category is selected */
//http://stackoverflow.com/questions/5285072/how-to-use-javascript-inside-a-php-echo-function
echo '<script src="php/cart.js"></script>';
echo '<ul class="products-wrp">';



 while($fetch = mysqli_fetch_assoc($output))
{
     
         
         
        $_SESSION['product_Name'] = $fetch['product_name'];
        
       // $_SESSION['product_Id'] = $fetch['id'];
       // echo 'product_details.php?y='.$_SESSION['product_Id'];
          

            echo '<li>';
            echo'<form class="form-item">';
            echo '<h4><a href="product_details.php?x='.$_SESSION['product_Name'].'">'.$fetch["product_name"].'</a></h4>';
            //unset($_SESSION['product_Name']);
            //echo '<h4><a href="product_details.php">'.$fetch["product_name"].'</a></h4>';
            echo'<div><img width="220px" height="220px" src="images/'.$fetch["product_image"].'"></div>';
            echo'<div>Price: '.$fetch["product_price"].'<div>';
            echo'<div>Category: '.$fetch["category"].'<div>';
            // echo'<div>'.$fetch["product_desc"].'<div>'; 
            echo'<div class="item-box">';
            echo'<div >Summary: '.$fetch["product_desc"].'<div>';
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

 
                      
//exit();
//session_unset();
?>