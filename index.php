<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
		$mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$phone = filter_var($_POST['cellphone'], FILTER_SANITIZE_NUMBER_INT);
		$msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
		
		$formErrors = array();
		if (strlen($user) <= 3) {
			$formErrors[] = 'UserName Must Be Larger Than 3 Characters';
			$GLOBALS['x']=1;
		}
		if (strlen($msg) <= 10) {
			$formErrors[] = 'Message Must Be Larger Than 10 Characters';
			$GLOBALS['x']=1;
		}
		
		$headers='From: ' . $mail . '\r\n';
		$myemail="hamada.mahmoud880@gmail.com";
		$subject='Contact Form';

		if(empty($formErrors)) {
			mail($myemail, $subject, $msg, $headers);
			// $user = '';
			// $mail = '';
			// $phone = '';
			// $msg = '';
			$success="<div class='alert alert-success'>Send Message Successfully</div>";
			$GLOBALS['x']=0;
		}
		if($x==0){
		try {
			$dsn='mysql:host=localhost;dbname=c_form';
			$connection = new PDO($dsn, 'root', '');
			$q = "INSERT INTO c_info (username, email, phonenum, message) VALUES ('$user', '$mail', '$phone', '$msg')";
			$connection->exec($q);
			$user = '';
			$mail = '';
			$phone = '';
			$msg = '';
			}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}
	// f(empty($formErrors)) {
	// 		$user = '';
	// 		$mail = '';
	// 		$phone = '';
	// 		$msg = '';
	// 	}
	
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Contact Form</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700,900">
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div class="container">
			<h2 class="text-center">Contact Me</h2>
			<form class="contact_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<?php
				if (! empty($formErrors)) {
			?>
				<div class="error">
				<i class="fa fa-close closee"></i>
				<p>
				<?php
					foreach ($formErrors as $error) {
						echo "<i class='fa fa-frown-o'> </i> " . "$error <br/>";
								}
								?>
					</p>
					</div>
					<?php } ?>
					<?php if (isset($success)) {
						echo "$success";
					} ?>
				<div class="form-group">
				<input class="form-control username" type="text" name="username" placeholder="Type Your Username"
				value="<?php if (isset($user)) {echo "$user";} ?>" required>
				<i class="fa fa-user fa-fw"></i>
				<span class="star1">*</span>
				</div>
				<div class="form-group">
				<input class="form-control" type="email" name="email" placeholder="Type your Valide Email"
				value="<?php if (isset($mail)) {echo "$mail";} ?>" required>
				<i class="fa fa-envelope fa-fw"></i>
				<span>*</span>
				</div>
				<input class="form-control" type="text" name="cellphone" placeholder="Type Your Phone Number"
				value="<?php if (isset($phone)) {echo "$phone";} ?>" required>
				<i class="fa fa-phone fa-fw"></i>
				<div class="form-group">
				<textarea class="form-control" name="message" placeholder="Your Message" required></textarea>
				<input class="btn btn-success send_it" type="submit" value="Send Message">
				<i class="fa fa-check-circle-o fa-fw send_icon"></i>
				<span>*</span>
				</div>
			</form>
		</div>









	<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
	</body>
</html>