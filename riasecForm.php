<?php // riasec questionnaire Ed Jones  5/22/2020
//Front End Changed Faiza Maghrabi:
//NOTES:
//Session based code is commented off (23-36, 45, 117-125, 157-189, 248-250, 262) - but the line numbers have changed as I have coded
//More errors given below in localhost


session_start();

$debug=false;
$lookup = array();
// get questions
$fh=fopen("riasec_questions.json","r");
$workstring=fread($fh,filesize("riasec_questions.json"));
if($debug){echo $workstring;}
$lookup=json_decode($workstring,TRUE);
fclose($fh);
if($debug){echo "<p>json_decode error =" . json_last_error_msg() . "</p>";}
if($debug){echo "<p> Scores =" . $lookup . "</p>";}
if($debug){print_r($lookup);}


// open up db connection for result save
// require ("connect.php");
// $result = [];

// $userip=$_SERVER['REMOTE_ADDR'];

// Check for existing RIASEC scores
// $score_exist = false;
// $sql="SELECT * FROM " . $dbname . ".interest_scores WHERE userid='" . $_SESSION["userid"] . "' ORDER BY interest_scores_date DESC";
// $result = $con->query($sql);
// $scores=[];
// if($result->num_rows > 0){  // RIASEC scores for this user exist ... first record fetched is the latest
// $score_exist = true;
// $scores=$result->fetch_assoc();	
// }

//$sql="SELECT * FROM inferent_ifutures.profile WHERE profile_owner=" . $_SESSION['userid'] . " ORDER BY profile_date DESC";
//$result = $con->query($sql);
//if ($result->num_rows == 0){
//	echo "<script>alert('No Personality Profile Was Found'); </script>";
//}else{
//$row=$result->fetch_assoc();

// $con->close();

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
	
	 <!-- <link rel="stylesheet" href="css/responsive.css"> -->
	<script src="../chart/Chart.min.js"></script>
	<script src="../chart/samples/utils.js"></script>
	<style>
		canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}
		table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
		text-align: center;
		}
	</style>

</head>

<body>

<!-- check if user logged in and display appropriate top menu -->

<!-- <?php
//echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
if (isset($_SESSION["authorized"])== FALSE) {
	include('./includes/top-menu-notloggedin.html');
}
else {
	include('./includes/top-menu-loggedin.html');
}
?> -->

<!-- end of top menu -->

	         <!-- bradcam_area  -->
         <div class="bradcam_area bradcam_bg_4">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="bradcam_text text-center">
                                <h3>Your Interests</h3>
								
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
	// if($score_exist == true){
	// echo "<h5>Your Most Recent Interest Scores from " . $scores["interest_scores_date"] . "</h5>";
	// echo "<p>The numbers indicate your level of interest on a scale of 1 to 40 ... with 40 being very high interest</p>";
	// echo "<table>";
	// echo "<tr>";
	// echo "<td>Realistic (Things)</td>";
	// echo "<td>  " . $scores["interest_scores_r"] . "  </td>";
	// echo "</tr>";
	// echo "<td>Investigative (Ideas)</td>";
	// echo "<td>  " . $scores["interest_scores_i"] . "  </td>";
	// echo "</tr>";
	// echo "<td>Artistic (Creativity)</td>";
	// echo "<td  >" . $scores["interest_scores_a"] . "  </td>";
	// echo "</tr>";
	// echo "<td>Social (People)</td>";
	// echo "<td  >" . $scores["interest_scores_s"] . "  </td>";
	// echo "</tr>";
	// echo "<td>Enterprising (Tasks)</td>";
	// echo "<td  >" . $scores["interest_scores_e"] . "  </td>";
	// echo "</tr>";
	// echo "<td>Conventional (Order)</td>";
	// echo "<td  >" . $scores["interest_scores_c"] . "  </td>";
	// echo "</tr>";
	// echo "</table>";
	
	// echo "<br><br>";
	// echo "<img src='img/Holland-RIASEC.png' alt = 'Holland Interest Scale' height = '500' width = '500' ></img>";
	// echo "<br><br>";
	// echo "<h5>You May Retake The Interest Profile Below To Reset Your Interest Scores ... OR</h5><br><br>";
	// echo "<form action='/onet.php' method='post'>";
	// echo "<button type='submit' style='height:50px;width:300px'>Tick To Get Your Career Suggestions</button><br>";
	// echo "</form>";
	// }
	?>
	<br><br>
	<!-- NEW CODE AFTER THIS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js" integrity="sha512-H6cPm97FAsgIKmlBA4s774vqoN24V5gSQL4yBTDOY2su2DeXZVhQPxFK4P6GPdnZqM9fg1G3cMv5wD7e6cFLZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!--Progress bar html set up-->
	<div id="bar-hold" class="invisible" style="position:relative; width: 100%; border: 1px solid black">
        <div  id="progress-bar" style="background-color: #223B52; height: 30px; width:0%"></div>
	</div>


	<script src="riasecForm.js" defer></script>
	<section class="visible" id="-1" >
		<h3>Interest Survey</h4>
		<h4>Don't worry about whether you have the skills or training to do an activity - or about how much money you might make. </h4> 
		<h4>Just think about whether you would enjoy doing it or not and rate each item from 1 (Would hate doing it!) to 5 (Would love doing it!).</h4>
		<h4>Press the Button below to begin!</h4>
		<button type="button" class="button" style=' width:100%; font-size: 80px text-align:center; background-color: #223B52; color: white; font-weight: 700;'>Start</button>
	</section>

	</div>


	
	<style>
		/* toggle visibility */
		.visible{
			style.display: "block";
		}

		.invisible{
			style.display: "none";
			position: absolute;
		}

		img{
			width:80px;
		}

	</style>

	<?php
		//Method to load a new question when button is pressed - first need to test if I can edit pre given lines in html:
		//PLAN: load all questions using php but give them the invisible class (change to tag?) within a container,
		//this way, the questions will still be associated to the form and not visible for the user - forward and backward buttons?
		//Once a button is pressed (next) the current visible question is hidden and the next one is shown (change tag on button to keep track of question numbers)
		//JS FILE IS NEEDED TO DO THIS
	?>

	<?php
		echo "<h1 class='number' id='1'></h1>";
		$resultForm = "<form width:100% action='riasecResult.php' method='POST'>";
		for ($x=0;$x<count($lookup);$x++){
			$number=$lookup[$x]['question#'];
			$area=$lookup[$x]['area'];
			$question=$lookup[$x]['text'];

			$resultForm= $resultForm . "<section class='invisible' id='".$number."'>";
			$resultForm = $resultForm . "<br><label style='font-weight: 900; color: #223B52; padding: 0.5vw; font-size: 25px' for='" . $number . "'>" . $question . "</label><br><p></p>";
			for($y=0;$y<5;$y++){ 
				$initpng = "Emojis/".($y + 1).".png";

				//$resultForm = $resultForm . "<input type='radio' style='height:35px; width:35px;' name='" . $number . "' id='" . $number . "' value='" . $y . "'>  </>";


				$resultForm = $resultForm . "<input type='radio' style='height:35px; width:35px;' name='" . $number . "' id='" . $number . " ".$y."' class='invisible' value='".$y."'>  
				<label for='" . $number . " ".$y."'><img onmouseover=hover(".$number.",".$y.") onmouseout=hoverOff(".$number.",".$y.") src='".$initpng."' alt='png ".($y + 1)."' /></label></>";
			}
		$resultForm= $resultForm . "</section>";
		}
		$resultForm = $resultForm . "<p></p><button type='button' class='invisible' id='back' style='padding:5px 40px; font-size: 80px text-align:center; background-color: #223B52; color: white; font-weight: 700;'>Back</button><p></p>";
		$resultForm = $resultForm . "<input type='submit' class='invisible' value='Submit for Scoring' style='width:100%; font-size: 80px text-align:center; background-color: #223B52; color: white; font-weight: 700;'>";
		$resultForm=$resultForm . "</form>";
		echo $resultForm;
	?>
	<p>
		<br /><a href="holland.php">Find out more about the Holland Interest Questionnaire here</a>
	</p>
	<?php
		// if($_SESSION['username']=="TMP"){
		// 	echo "<p>As a registered user you will have access to detailed personality analysis results, a personal interest assessment, recommended careers, personalized recommendation regarding upcoming events that fit you perfectly.  <a href='newlogin.php'>REGISTER NOW</a></p>";
		// }
	?>

					</div>
            </div>
        </div>
    </div>
	</div>   	

	<!-- Single column content area end -->

	<?php 
		// include('./includes/footer.html'); 
	?>

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
	
	<script>
	function validate(form){
		
	}
	
	</script>

</body>

</html>
