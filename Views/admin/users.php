<?php
$current_index = isset($_GET["next"]) && is_numeric($_GET["next"])? (int)$_GET["next"] : 0;
$next_index = $current_index + __RECORDS_PER_PAGE__;
$previous_index =  ($current_index - __RECORDS_PER_PAGE__ >0) ? $current_index - __RECORDS_PER_PAGE__ : 0 ;
$all_accounts = $user->get_data(array(),$current_index);


?>

<html>
    <head>
        
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/fav.png">
        <!-- Author Meta -->
        <meta name="author" content="CodePixar">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title>All Profiles</title>

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
            <!--
            CSS
            ============================================= -->
            <link rel="stylesheet" href="cssA/linearicons.css">
            <link rel="stylesheet" href="cssA/owl.carousel.css">
            <link rel="stylesheet" href="cssA/font-awesome.min.css">
            <link rel="stylesheet" href="cssA/nice-select.css">
            <link rel="stylesheet" href="cssA/magnific-popup.css">
            <link rel="stylesheet" href="cssA/bootstrap.css">
            <link rel="stylesheet" href="cssA/main.css">
            
        </head>
        <body>
            
            
            
            
            
            <div>
                <a href=<?php echo $_SERVER["PHP_SELF"]."?logout"; ?> class="primary-btn submit-btn d-inline-flex align-items-center mt-20"><span class="mr-10">Log Out</span> </a>
            </div>    
                
            
			<!-- Start Remarkable Wroks Area -->
			<!-- <section class="remarkable-area"> -->
                <div class="container">
                    <?php
                    foreach($all_accounts as $account)
                    {
                        if($account["is_admin"]!=1)
                        {
                            echo"
                            <div class='single-remark'>
                            <div class='row no-gutters'>
                            <div class='col-lg-7 '>
								<div class='remark-thumb' style='background: url(profile_pictures/".$account["image"].");'></div>
							</div>
						
                            <div class='col-lg-5 col-md-6'>
                            <div class='remark-desc'>
                            <h4>".$account["name"]."</h4>
                            <p>Job: ".$account["job"]."</p>
                            <p>User Name: ".$account["username"]."</p>
                            <a href='".$_SERVER["PHP_SELF"]."?id=".$account["id"]."'class='primary-btn'><span>More</span></a>
                            </div>
                            </div>
                            </div>
                            </div>";

                        }else{
                            continue;
                        }
                    } 
                    ?>
				</div>
			</section>
			<!-- End Remarkable Wroks Area -->
            <a href=<?php echo $_SERVER["PHP_SELF"]."?next=".$previous_index; ?> class="primary-btn d-inline-flex align-items-center"><span class="mr-10"> <- Previous </span></span></a>
            <a href=<?php echo $_SERVER["PHP_SELF"]."?next=".$next_index; ?> class="primary-btn d-inline-flex align-items-center"><span class="mr-10">Next -> </span></span></a>
            
            
            
            
            
        </body>
        </html>