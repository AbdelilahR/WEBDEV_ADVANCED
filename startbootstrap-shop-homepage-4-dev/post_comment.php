<?php
session_start();
error_reporting(0);
/*
$servername = "dt5.ehb.be";
$username = "WDA034";
$password = "Test123";
$dbname = "WDA034";
*/

$host="dt5.ehb.be";
$username="WDA034";
$password="Test123";
$databasename="WDA034";

$connect=mysql_connect($host,$username,$password);
$db=mysql_select_db($databasename);

//echo $product_name.' Place 1';
$product_name = $_SESSION['product_naam'];
if(isset($_POST['user_comm']) && isset($_POST['user_name']))
{
 //echo $product_name.' Place 2';
  $comment=$_POST['user_comm'];
  $name=$_POST['user_name'];
    $query = "INSERT INTO commenting VALUES ('','$name','$comment',CURRENT_TIMESTAMP,'{$product_name}');";
//   / echo $query;
   $insert=mysql_query($query);
    
 
  
  $id=mysql_insert_id($insert);

    $select=mysql_query("select * from commenting WHERE product_name='{$product_name}'");
  
  if($row=mysql_fetch_array($select))
  {
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
  }
exit;
}

?>