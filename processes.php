<?php 
	include 'config.php';

	// USERS LOGIN - LOGIN.PHP
	if(isset($_POST['login'])) {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
		if(mysqli_num_rows($check)===1) {
			$row = mysqli_fetch_array($check);
			$position = $row['user_type'];
			if($position == 'Admin' || $position == 'Staff') {
				$_SESSION['admin_Id'] = $row['user_Id'];
				header("Location: Admin/dashboard.php");
			} else {
				$_SESSION['user_Id'] = $row['user_Id'];
				header("Location: User/enrollmentInfo.php");
			}
		} else {
			$_SESSION['message'] = "Incorrect password.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: login.php");
		}
	}



	// SAVE USERS - REGISTER.PHP
	if(isset($_POST['create_user'])) {
		$enrollmentType   = mysqli_real_escape_string($conn, $_POST['enrollmentType']);
		$firstname        = mysqli_real_escape_string($conn, $_POST['firstname']);
		$middlename       = mysqli_real_escape_string($conn, $_POST['middlename']);
		$lastname         = mysqli_real_escape_string($conn, $_POST['lastname']);
		$suffix           = mysqli_real_escape_string($conn, $_POST['suffix']);
		$dob              = mysqli_real_escape_string($conn, $_POST['dob']);
		$age              = mysqli_real_escape_string($conn, $_POST['age']);
		$birthplace       = mysqli_real_escape_string($conn, $_POST['birthplace']);
		$gender           = mysqli_real_escape_string($conn, $_POST['gender']);
		$civilstatus      = mysqli_real_escape_string($conn, $_POST['civilstatus']);
		$occupation       = mysqli_real_escape_string($conn, $_POST['occupation']);
		$religion		  = mysqli_real_escape_string($conn, $_POST['religion']);
		$nationality 	  = mysqli_real_escape_string($conn, $_POST['nationality']);
		$email		      = mysqli_real_escape_string($conn, $_POST['email']);
		$contact		  = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no         = mysqli_real_escape_string($conn, $_POST['house_no']);
		$street_name      = mysqli_real_escape_string($conn, $_POST['street_name']);
		$purok            = mysqli_real_escape_string($conn, $_POST['purok']);
		$zone             = mysqli_real_escape_string($conn, $_POST['zone']);
		$barangay         = mysqli_real_escape_string($conn, $_POST['barangay']);
		$municipality     = mysqli_real_escape_string($conn, $_POST['municipality']);
		$province         = mysqli_real_escape_string($conn, $_POST['province']);
		$region           = mysqli_real_escape_string($conn, $_POST['region']);
		$password         = md5($_POST['password']);
		$guardianName 	  = mysqli_real_escape_string($conn, $_POST['guardianName']);
		$guardianContact  = mysqli_real_escape_string($conn, $_POST['guardianContact']);
		$schoolName       = mysqli_real_escape_string($conn, $_POST['schoolName']);
		$schoolAddress    = mysqli_real_escape_string($conn, $_POST['schoolAddress']);
		$yearLevel        = mysqli_real_escape_string($conn, $_POST['yearLevel']);
		$file             = basename($_FILES["fileToUpload"]["name"]);
		$certificate 	  = basename($_FILES["certificate"]["name"]);
		$date_registered  = date('Y-m-d');

		if(empty($file)) {

			$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if(mysqli_num_rows($check_email)>0) {
			      $_SESSION['message'] = "Email already exists!";
			      $_SESSION['text'] = "Please try again.";
			      $_SESSION['status'] = "error";
				  header("Location: register.php");
			} else {

				// Check if image file is a actual image or fake image
				    $target_dir = "images-document/";
				    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
				    $uploadOk = 1;
				    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				    $check = getimagesize($_FILES["certificate"]["tmp_name"]);
					if($check == false) {
					    $_SESSION['message']  = "Document is not an image.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");
				    	$uploadOk = 0;
				    } 

					// Check file size // 500KB max size
					elseif ($_FILES["certificate"]["size"] > 500000) {
					  	$_SESSION['message']  = "Document must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");
				    	$uploadOk = 0;
					}

				    // Allow certain file formats
				    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");
					    $uploadOk = 0;
				    }

				    // Check if $uploadOk is set to 0 by an error
				    elseif ($uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");

				    // if everything is ok, try to upload file
				    } else {

			        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

		        		$save = mysqli_query($conn, "INSERT INTO users (enrollmentType, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, nationality, house_no, street_name, purok, zone, barangay, municipality, province, region, document, password, guardianName, guardianContact, schoolName, schoolAddress, yearLevel, date_registered) VALUES ('$enrollmentType', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$nationality', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$certificate', '$password', '$guardianName', '$guardianContact', '$schoolName', '$schoolAddress', '$yearLevel', '$date_registered')");

		              	  if($save) {
				          	$_SESSION['message'] = "Registration successful!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: register.php");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: register.php");
				          }
			       			
			        } else {
			        	$_SESSION['message'] = "There was an error uploading your document.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: register.php");
			        }
				  }
			}

		} else {

			$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if(mysqli_num_rows($check_email)>0) {
			      $_SESSION['message'] = "Email already exists!";
			      $_SESSION['text'] = "Please try again.";
			      $_SESSION['status'] = "error";
				  header("Location: register.php");
			} else {

				// Check if image file is a actual image or fake image
			    $target_dir = "images-users/";
			    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			    $uploadOk = 1;
			    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "Profile picture is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register.php");
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "Profile picture must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register.php");
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register.php");
				    $uploadOk = 0;
			    }

			    // Check if $uploadOk is set to 0 by an error
			    elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: register.php");

			    // if everything is ok, try to upload file
			    } else {

		        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

	        		// Check if image file is a actual image or fake image
				    $target_dir = "images-document/";
				    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
				    $uploadOk = 1;
				    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				    $check = getimagesize($_FILES["certificate"]["tmp_name"]);
					if($check == false) {
					    $_SESSION['message']  = "Document is not an image.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");
				    	$uploadOk = 0;
				    } 

					// Check file size // 500KB max size
					elseif ($_FILES["certificate"]["size"] > 500000) {
					  	$_SESSION['message']  = "Document must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");
				    	$uploadOk = 0;
					}

				    // Allow certain file formats
				    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");
					    $uploadOk = 0;
				    }

				    // Check if $uploadOk is set to 0 by an error
				    elseif ($uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: register.php");

				    // if everything is ok, try to upload file
				    } else {

			        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

		        		$save = mysqli_query($conn, "INSERT INTO users (enrollmentType, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, nationality, house_no, street_name, purok, zone, barangay, municipality, province, region, image, document, password, guardianName, guardianContact, schoolName, schoolAddress, yearLevel, date_registered) VALUES ('$enrollmentType', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$nationality', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$certificate', '$password', '$guardianName', '$guardianContact', '$schoolName', '$schoolAddress', '$yearLevel', '$date_registered')");

		              	  if($save) {
				          	$_SESSION['message'] = "Registration successful!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: register.php");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: register.php");
				          }
			       			
			        } else {
			        	$_SESSION['message'] = "There was an error uploading your document.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: register.php");
			        }
				  }
		       			
		        } else {
		        	$_SESSION['message'] = "There was an error uploading your profile picture.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: register.php");
		        }
			  }
			}
		}


		
	}
?>
