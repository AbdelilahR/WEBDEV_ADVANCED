<?php
require_once("php/dbcontroller.php");
require_once("php/cart.php");
/*
session_start();
require_once("php/dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
*/
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
$(document).ready(function(){	
		$(".form-item").submit(function(e){
			var form_data = $(this).serialize();
			var button_content = $(this).find('button[type=submit]');
			button_content.html('Adding...'); //Loading button text 

			$.ajax({ //make ajax request to cart_process.php
				url: "cart_process.php",
				type: "POST",
				dataType:"json", //expect json value from server
				data: form_data
			}).done(function(data){ //on Ajax success
				$("#cart-info").html(data.items); //total items in cart-info element
				button_content.html('Add to Cart'); //reset button text to original text
				alert("Item added to Cart!"); //alert user
				if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
					$(".cart-box").trigger( "click" ); //trigger click to update the cart box.
				}
			})
			e.preventDefault();
		});

	//Show Items in Cart
	$( ".cart-box").click(function(e) { //when user clicks on cart box
		e.preventDefault(); 
		$(".shopping-cart-box").fadeIn(); //display cart box
		$("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
		$("#shopping-cart-results" ).load( "cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
	});
	
	//Close Cart
	$( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
		e.preventDefault(); 
		$(".shopping-cart-box").fadeOut(); //close cart-box
	});
	
	//Remove items from cart
	$("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
		e.preventDefault(); 
		var pcode = $(this).attr("data-code"); //get product code
		$(this).parent().fadeOut(); //remove item element from box
		$.getJSON( "cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
			$("#cart-info").html(data.items); //update Item count in cart-info
			$(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
		});
	});

});
</script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <div class="collapse navbar-collapse" id="navbarExample">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <a href="#" class="list-group-item">Action</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                    <a href="#" class="list-group-item">Category 4</a>
                    <a href="#" class="list-group-item">Category 5</a>
                    <a href="#" class="list-group-item">Category 6</a>
                    <a href="#" class="list-group-item">Category 7</a>
                    <a href="#" class="list-group-item">Category 8</a>
                    <a href="#" class="list-group-item">Category 9</a>
                    <a href="#" class="list-group-item">Category 10</a>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="row">                    
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                    <?php
                                            $product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id = '1' ");
                                            if (!empty($product_array)) { 
                                                foreach($product_array as $key=>$value){
                                                    /* <form class="test" method="post" action="php/cart.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>"> */
                                       ?>
                                         <form class="form-item">
                                             
                                            <a href="#"><img class="card-img-top img-fluid" src="<?php echo $product_array[$key]["image"]; ?>" alt=""></a>
                                                 <div class="card-block">
                                                    <h4 class="card-title"><a href="#"><?php echo $product_array[$key]["name"]; ?></a></h4>
                                                    <h5 class="card-price"><?php echo $product_array[$key]["price"]; ?></h5>
                                                    <p class="card-text"><?php echo $product_array[$key]["description"]; ?></p>
                                                   <!--
                                                     <div>
                                                        <input type="text" name="quantity" value="1" size="2" />
                                                        <input type="submit" value="Add to cart" class="btnAddAction" />
                                                     </div> 
                                                    -->
                                                    <button type="submit" name="quantity" value="1" class="btnAddAction">Add</button> 
                                                    
                                                    <h6 class="card-cat"><?php echo $product_array[$key]["code"]; ?></h6>
                                                </div>
                                            </form>
                                    <?php
                                                                                        }
                                                                        }
                                    ?>
                                    <div class="card-footer">
                                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    </div>
                            </div>
                    </div>

                   <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>




                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <a href="#"><img class="card-img-top img-fluid" src="pictures/products/2015-05-06-free-movies-at-wedge.jpg" alt="">
                            </a>
                            <div class="card-block">
                                <h4 class="card-title"><a href="#">Item One</a></h4>
                                <h5 class="card-price">$24.99</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! </p>
                                <div class="card-button">
                                    <button class="divbutton"></button>
                                </div>


                                <h6 class="card-cat">Action</h6>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

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
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom JQuerry -->
    <script src="jquery-3.2.0.min.js"></script>
    <script src="php/cart.js"></script>
    
    </body>

</html>