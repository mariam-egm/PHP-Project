<?php
$index = (isset($_GET["index"]))? (int)$_GET["index"] : 0;
$current_account = $user->get_record($_GET["id"])[0];
$user_name = $current_account["username"];
$name = $current_account["name"];
$email = $current_account["email"];
$img = $current_account["image"];
$cv = $current_account["cv"];
$job = $current_account["job"];
?>


<html>


<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Single Profile</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/animate-css/animate.css">
        <link rel="stylesheet" href="vendors/popup/magnific-popup.css">
        <link rel="stylesheet" href="vendors/flaticon/flaticon.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
</head>

<body>


        <!--================Home Banner Area =================-->
        <section class="home_banner_area">
           	<div class="container box_1620">
           		<div class="banner_inner d-flex align-items-center">
					<div class="banner_content">
						<div class="media">
							<div class="d-flex">
								<img src="<?php echo "profile_pictures/".$img; ?>" alt="">
							</div>
							<div class="media-body">
								<div class="personal_text">
									<h6>Hello, I am </h6>
									<h3><?php  echo"$user_name"   ;?></h3>
									<h4><?php  echo"$job"   ;?></h4>
									<p>You will begin to realise why this exercise is called the Dickens Pattern (with reference to the ghost showing Scrooge some different futures)</p>
                                    <ul class="list basic_info">

										<li><a href="#"><i class="lnr lnr-phone-handset"></i> User Name: <?php  echo"$user_name"   ;?></a></li>
										<li><a href="#"><i class="lnr lnr-envelope"></i> Email:  <?php  echo"$email"   ;?></a></li>
                                    
                                    </ul>


									<ul class="list personal_social">
										<li>
                                            <a href="<?php echo $_SERVER["PHP_SELF"]."?users"; ?>" > Go to all accounts </a>
                                        </li>



										<li>
                                            <?php 
                                                echo "<a href= '" . $_SERVER["PHP_SELF"] . "?logout '> 
                                                Log out</a>";
                                            ?>

                                        </li>
									</ul>

								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>
        <!--================End Home Banner Area =================-->
        
</body>

</html>