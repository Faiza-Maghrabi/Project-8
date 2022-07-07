<?php // riasec questionnaire resultEd Jones  5/22/2020
session_start();
$debug=false;
if($debug){ echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; }
$textsavedate = date("Y-m-d H:i:s");
$lookup = array();
$riasec=array();
// get questions
$fh=fopen("riasec_questions.json","r");
$workstring=fread($fh,filesize("riasec_questions.json"));
if($debug){echo $workstring;}
$lookup=json_decode($workstring,TRUE);
fclose($fh);
if($debug){echo "<p>json_decode error =" . json_last_error_msg() . "</p>";}
if($debug){echo "<p> Scores =" . $lookup . "</p>";}
if($debug){print_r($lookup);}

// load scores to lookup
for ($x=1;$x<count($lookup)+1;$x++){
$lookup[$x-1]['score']=$_POST[$x];	
}
if($debug){echo '<pre>' . print_r($lookup, TRUE) . '</pre>';}
// calculate summary scores
for($x=0;$x<count($lookup);$x++){
if($lookup[$x]['area']=="Realistic"){$riasec[0]=$riasec[0]+$lookup[$x]['score'];}
if($lookup[$x]['area']=="Investigative"){$riasec[1]=$riasec[1]+$lookup[$x]['score'];}
if($lookup[$x]['area']=="Artistic"){$riasec[2]=$riasec[2]+$lookup[$x]['score'];}
if($lookup[$x]['area']=="Social"){$riasec[3]=$riasec[3]+$lookup[$x]['score'];}
if($lookup[$x]['area']=="Enterprising"){$riasec[4]=$riasec[4]+$lookup[$x]['score'];}
if($lookup[$x]['area']=="Conventional"){$riasec[5]=$riasec[5]+$lookup[$x]['score'];}
}
// report


?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inferential Futures</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon code in here -->
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <!-- icon files in root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

</head>

<body>

<!-- check if user logged in and display appropriate top menu -->

<?php
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
if (isset($_SESSION['userid'])== FALSE || $_SESSION['username'] == "TMP") {
	include('./includes/top-menu-notloggedin.html');
}
else {
	include('./includes/top-menu-loggedin.html');
}
?>

<!-- end of top menu -->

	         <!-- bradcam_area  -->
         <div class="bradcam_area bradcam_bg_4">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>Your Interest Results</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ bradcam_area  -->
	
  	<!-- Single column content area -->
	
	    <div class="listing_details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="single_details">

<!--	<div style="width:40%"> -->

	<div>
	<?php
	$results = "<p>Realistic = " . $riasec[0] . "</p>";
	$results = $results . "<p>Investigative = " . $riasec[1] . "</p>";
	$results = $results . "<p>Artistic = " . $riasec[2] . "</p>";
	$results = $results . "<p>Social = " . $riasec[3] . "</p>";
	$results = $results . "<p>Enterprising = " . $riasec[4] . "</p>";
	$results = $results . "<p>Conventional = " . $riasec[5] . "</p>";
	echo $results;
	
	// save results to db
	
	// open up db connection for result save
	$host = "185.20.50.28";  
	$dbname = "inferent_ifutures";
	$user = "inferent_user";
	$password = "6iS?{i#jO.$*";
	$port=1198;  // do not use port assignment if running on TCO Host
	$socket=0;
	$result = [];

	$userip=$_SERVER['REMOTE_ADDR'];
	// Create connection

	$con = mysqli_connect($host, $user, $password, $dbname)
		or die ('Could not connect to the database server   ' . mysqli_connect_error());
		
	$source="10";
	$type="10";
	$version="test";
	$values="'" . $_SESSION['userid'] . "','" . $textsavedate . "','" . $source . "','" . $type . "','" . $version . "','" . $riasec[0] . "','" . $riasec[1] . "','" . $riasec[2] . "','" . $riasec[3] . "','" . $riasec[4] . "','" . $riasec[5] . "'";
	$datafields="userid, interest_scores_date, interest_scores_source, interest_scores_type, interest_scores_version, interest_scores_r, interest_scores_i, interest_scores_a, interest_scores_s, interest_scores_e, interest_scores_c";
	$sql="INSERT INTO inferent_ifutures.interest_scores (" . $datafields . ") VALUES (" . $values . ")";
	$result = $con->query($sql);
	
	$con->close();
	
	echo "<p>Results Saved To Your Profile</p>";
	echo "<a href='onetRecalc.php'>Request Updated Career Recommendations</a>";
	?>
	
	
	<style>
	
	</style>
	
	
		
	</div>



	<p><br /><a href="holland.php">Find out more about the Holland Interest Questionnaire here</a>
	</p>
	<?php
	if($_SESSION['username']=="TMP"){
		echo "<p>As a registered user you will have access to detailed personality analysis results, a personal interest assessment, recommended careers, personalized recommendation regarding upcoming events that fit you perfectly.  <a href='newlogin.php'>REGISTER NOW</a></p>";
	}
	
	
	?>

					</div>
            </div>
        </div>
    </div>
	</div>   	

	<!-- Single column content area end -->

	<?php include('./includes/footer.html'); ?>

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/slick.min.js"></script>
   

    
    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/main.js"></script>
	
	

</body>

</html>
