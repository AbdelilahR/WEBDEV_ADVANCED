<?php
include 'connect.php';

    if (isset($_POST['card-title'])) {
    $title = $_POST['card-title'];
}

if (isset($_POST['card-price'])) {
    $card_price = $_POST['card-price'];
}

if (isset($_POST['card-text'])) {
    $card_text = $_POST['card-text'];
}
if (isset($_POST['card-cat'])) {
    $card_cat = $_POST['card-cat'];
}

   $title = $_POST["card-title"];
   $card_price = $_POST["card-price"];
   $card_text = $_POST["card-text"];
   $card_cat = $_POST["card-cat"];

$query ="INSERT INTO Products (Name, Description, Price, Category)
         VALUES ('$card_title','$card_price','$card_text','$card_cat')"; 
$query_run = mysql_query($query);
    
 if ($query_run)
          { 
                echo 'It is working';
          }
/*

$query = "INSERT INTO `user_table`(`NAME`,`EMAIL_ID`,`PASSWORD`,`CREDITS`,`CREATED_ON`,`MODIFIED_ON`)
         VALUES
         ('$NAME','$EMAIL_ID','$PASSWORD','$CREDITS','$CREATED_ON','$MODIFIED_ON')";
         $query_run= mysql_query($query);
        // $retval=mysql_query($query,$conn);
          if ($query_run)
          { 
                echo 'It is working';
          }
*/
/*
$sql = "INSERT INTO Products (Name, Description, Price)
VALUES ('John', 'Doe', '7')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>