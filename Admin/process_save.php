<?php 
	include '../config.php';
	include('../phpqrcode/qrlib.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/PHPMailer/src/Exception.php';
	require '../vendor/PHPMailer/src/PHPMailer.php';
	require '../vendor/PHPMailer/src/SMTP.php';
	date_default_timezone_set('Asia/Manila');


	// SAVE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['create_admin'])) {
		$user_type		  = mysqli_real_escape_string($conn, $_POST['user_type']);
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
		$file             = basename($_FILES["fileToUpload"]["name"]);
		$date_registered  = date('Y-m-d');


		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
		if(mysqli_num_rows($check_email)>0) {
		      $_SESSION['message'] = "Email already exists!";
		      $_SESSION['text'] = "Please try again.";
		      $_SESSION['status'] = "error";
			  header("Location: admin_mgmt.php?page=create");
		} else {

			// Check if image file is a actual image or fake image
		    $target_dir = "../images-users/";
		    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check == false) {
			    $_SESSION['message']  = "File is not an image.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=create");
		    	$uploadOk = 0;
		    } 

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
			  	$_SESSION['message']  = "File must be up to 500KB in size.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=create");
		    	$uploadOk = 0;
			}

		    // Allow certain file formats
		    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=create");
			    $uploadOk = 0;
		    }

		    // Check if $uploadOk is set to 0 by an error
		    elseif ($uploadOk == 0) {
			    $_SESSION['message'] = "Your file was not uploaded.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=create");

		    // if everything is ok, try to upload file
		    } else {

	        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        		$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, image, password, user_type, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$password', '$user_type', '$date_registered')");

              	  if($save) {
		          	$_SESSION['message'] = "Record has been saved!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: admin_mgmt.php?page=create");
		          } else {
		            $_SESSION['message'] = "Something went wrong while saving the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=create");
		          }
	       			
	        } else {
	        	$_SESSION['message'] = "There was an error uploading your profile picture.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: admin_mgmt.php?page=create");
	        }
		  }
		}
	}




	// SAVE USERS - USERS_MGMT.PHP
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
				  header("Location: users_mgmt.php?page=create");
			} else {

				// Check if image file is a actual image or fake image
				    $target_dir = "../images-document/";
				    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
				    $uploadOk = 1;
				    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				    $check = getimagesize($_FILES["certificate"]["tmp_name"]);
					if($check == false) {
					    $_SESSION['message']  = "Document is not an image.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
				    	$uploadOk = 0;
				    } 

					// Check file size // 500KB max size
					elseif ($_FILES["certificate"]["size"] > 500000) {
					  	$_SESSION['message']  = "Document must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
				    	$uploadOk = 0;
					}

				    // Allow certain file formats
				    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
					    $uploadOk = 0;
				    }

				    // Check if $uploadOk is set to 0 by an error
				    elseif ($uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");

				    // if everything is ok, try to upload file
				    } else {

			        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

		        		$save = mysqli_query($conn, "INSERT INTO users (enrollmentType, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, nationality, house_no, street_name, purok, zone, barangay, municipality, province, region, document, password, guardianName, guardianContact, schoolName, schoolAddress, yearLevel, date_registered) VALUES ('$enrollmentType', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$nationality', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$certificate', '$password', '$guardianName', '$guardianContact', '$schoolName', '$schoolAddress', '$yearLevel', '$date_registered')");

		              	  if($save) {
				          	$_SESSION['message'] = "Registration successful!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: users_mgmt.php?page=create");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=create");
				          }
			       			
			        } else {
			        	$_SESSION['message'] = "There was an error uploading your document.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
			        }
				  }
			}

		} else {

			$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
			if(mysqli_num_rows($check_email)>0) {
			      $_SESSION['message'] = "Email already exists!";
			      $_SESSION['text'] = "Please try again.";
			      $_SESSION['status'] = "error";
				  header("Location: users_mgmt.php?page=create");
			} else {

				// Check if image file is a actual image or fake image
			    $target_dir = "../images-users/";
			    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			    $uploadOk = 1;
			    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "Profile picture is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "Profile picture must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
				    $uploadOk = 0;
			    }

			    // Check if $uploadOk is set to 0 by an error
			    elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");

			    // if everything is ok, try to upload file
			    } else {

		        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

	        		// Check if image file is a actual image or fake image
				    $target_dir = "../images-document/";
				    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
				    $uploadOk = 1;
				    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				    $check = getimagesize($_FILES["certificate"]["tmp_name"]);
					if($check == false) {
					    $_SESSION['message']  = "Document is not an image.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
				    	$uploadOk = 0;
				    } 

					// Check file size // 500KB max size
					elseif ($_FILES["certificate"]["size"] > 500000) {
					  	$_SESSION['message']  = "Document must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
				    	$uploadOk = 0;
					}

				    // Allow certain file formats
				    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
					    $uploadOk = 0;
				    }

				    // Check if $uploadOk is set to 0 by an error
				    elseif ($uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");

				    // if everything is ok, try to upload file
				    } else {

			        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

		        		$save = mysqli_query($conn, "INSERT INTO users (enrollmentType, firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, nationality, house_no, street_name, purok, zone, barangay, municipality, province, region, image, document, password, guardianName, guardianContact, schoolName, schoolAddress, yearLevel, date_registered) VALUES ('$enrollmentType', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$nationality', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$certificate', '$password', '$guardianName', '$guardianContact', '$schoolName', '$schoolAddress', '$yearLevel', '$date_registered')");

		              	  if($save) {
				          	$_SESSION['message'] = "Record has been saved!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: users_mgmt.php?page=create");
				          } else {
				            $_SESSION['message'] = "Something went wrong while saving the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=create");
				          }
			       			
			        } else {
			        	$_SESSION['message'] = "There was an error uploading your document.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=create");
			        }
				  }
		       			
		        } else {
		        	$_SESSION['message'] = "There was an error uploading your profile picture.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
		        }
			  }
			}
		}


		
	}






	// SAVE CUSTOMIZATION - CUSTOMIZATION_ADD.PHP
	if(isset($_POST['create_customization'])) {
		$file            = basename($_FILES["fileToUpload"]["name"]);
		$date_registered = date('Y-m-d');

		$count = mysqli_query($conn, "SELECT COUNT(customID) AS countID FROM customization");
		$row = mysqli_fetch_array($count);
		if($row['countID'] == 6) {
			$_SESSION['message'] = "Maximum number of customization have been reached.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: customize.php");
		} else {
			$exist = mysqli_query($conn, "SELECT * FROM customization WHERE picture='$file'");
			if(mysqli_num_rows($exist) > 0) {
				$_SESSION['message'] = "Image already exists in the database.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: customize.php");
			} else {
				// Check if image file is a actual image or fake image
			    $sign_target_dir = "../images-customization/";
			    $sign_target_file = $sign_target_dir . basename($_FILES["fileToUpload"]["name"]);
			    $sign_uploadOk = 1;
			    $sign_imageFileType = strtolower(pathinfo($sign_target_file,PATHINFO_EXTENSION));

			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "File is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: customize.php");
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: customize.php");
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($sign_imageFileType != "jpg" && $sign_imageFileType != "png" && $sign_imageFileType != "jpeg" && $sign_imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: customize.php");
				    $sign_uploadOk = 0;
			    }

			    // Check if $sign_uploadOk is set to 0 by an error
			    elseif ($sign_uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: customize.php");

			    // if everything is ok, try to upload file
			    } else {

		    		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $sign_target_file)) {
						  $save = mysqli_query($conn, "INSERT INTO customization (picture, date_added) VALUES ('$file', '$date_registered')");
					      if($save) {
					      	$_SESSION['message'] = "Image has been saved.";
					        $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: customize.php");
					      } else {
					        $_SESSION['message'] = "Something went wrong while saving the information.";
					        $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: customize.php");
					      }  
		    		} else {
						$_SESSION['message'] = "There was an error uploading your digital signature.";
		            	$_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: customize.php");
		    		}
			    }
			}
		}	
		
	}




	// CREATE/SAVE ACTIVITIY - ACTIVITY_ADD.PHP
	if(isset($_POST['create_activity'])) {

		$activity       = mysqli_real_escape_string($conn, $_POST['activity']);
		$actDate        = mysqli_real_escape_string($conn, $_POST['actDate']);
		$date_acquired  = date('Y-m-d');
		$save = mysqli_query($conn, "INSERT INTO announcement (actName, actDate, date_added) VALUES ('$activity', '$actDate', '$date_acquired')");

		  if($save) {
		  	$_SESSION['message'] = "New announcement has been added.";
		    $_SESSION['text'] = "Saved successfully!";
		    $_SESSION['status'] = "success";
			header("Location: announcement.php");
		  } else {
		    $_SESSION['message'] = "Something went wrong while saving the information.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: announcement.php");
		  }
	}




	// CREATE/SAVE SECTION - SECTION_ADD.PHP
	if(isset($_POST['create_section'])) {

		$section        = mysqli_real_escape_string($conn, $_POST['section']);
		$yearLevel      = mysqli_real_escape_string($conn, $_POST['yearLevel']);
		$fetch = mysqli_query($conn, "SELECT * FROM section WHERE sectionName='$section' AND yearLevel='$yearLevel'");
		if(mysqli_num_rows($fetch) > 0) {
			$_SESSION['message'] = "Section already exists.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: section.php");
		} else {
			 $save = mysqli_query($conn, "INSERT INTO section (sectionName, yearLevel) VALUES ('$section', '$yearLevel')");

			  if($save) {
			  	$_SESSION['message'] = "New section has been added.";
			    $_SESSION['text'] = "Saved successfully!";
			    $_SESSION['status'] = "success";
				header("Location: section.php");
			  } else {
			    $_SESSION['message'] = "Something went wrong while saving the information.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: section.php");
			  }
		}
	}



	// CREATE/SAVE SUBJECT - SUBJECT_MGMT.PHP
	if(isset($_POST['create_subject'])) {

		$section     = mysqli_real_escape_string($conn, $_POST['section']);
		$subject     = mysqli_real_escape_string($conn, $_POST['subject']);
		$subjectTime = mysqli_real_escape_string($conn, $_POST['subjectTime']);

		$fetch = mysqli_query($conn, "SELECT * FROM subject WHERE sectionId='$section' AND subjectName='$subject' AND subjectTime='$subjectTime'");
		if(mysqli_num_rows($fetch) > 0) {
			$_SESSION['message'] = "Subject already exists.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: subject_mgmt.php?page=create");
		} else {
			 $save = mysqli_query($conn, "INSERT INTO subject (sectionId, subjectName, subjectTime) VALUES ('$section', '$subject', '$subjectTime')");

			  if($save) {
			  	$_SESSION['message'] = "New subject has been added.";
			    $_SESSION['text'] = "Saved successfully!";
			    $_SESSION['status'] = "success";
				header("Location: subject_mgmt.php?page=create");
			  } else {
			    $_SESSION['message'] = "Something went wrong while saving the information.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: subject_mgmt.php?page=create");
			  }
		}
	}






	// SAVE TEACHER - TEACHER_MGMT.PHP
	if(isset($_POST['create_teacher'])) {
		$section		  = mysqli_real_escape_string($conn, $_POST['section']);
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
		$file             = basename($_FILES["fileToUpload"]["name"]);
		$date_registered  = date('Y-m-d');


		$check_email = mysqli_query($conn, "SELECT * FROM teacher WHERE t_email='$email'");
		if(mysqli_num_rows($check_email)>0) {
		      $_SESSION['message'] = "Email already exists!";
		      $_SESSION['text'] = "Please try again.";
		      $_SESSION['status'] = "error";
			  header("Location: teacher_mgmt.php?page=create");
		} else {

			// Check if image file is a actual image or fake image
		    $target_dir = "../images-users/";
		    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check == false) {
			    $_SESSION['message']  = "File is not an image.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: teacher_mgmt.php?page=create");
		    	$uploadOk = 0;
		    } 

			// Check file size // 500KB max size
			elseif ($_FILES["fileToUpload"]["size"] > 500000) {
			  	$_SESSION['message']  = "File must be up to 500KB in size.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: teacher_mgmt.php?page=create");
		    	$uploadOk = 0;
			}

		    // Allow certain file formats
		    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: teacher_mgmt.php?page=create");
			    $uploadOk = 0;
		    }

		    // Check if $uploadOk is set to 0 by an error
		    elseif ($uploadOk == 0) {
			    $_SESSION['message'] = "Your file was not uploaded.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: teacher_mgmt.php?page=create");

		    // if everything is ok, try to upload file
		    } else {

	        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        		$save = mysqli_query($conn, "INSERT INTO teacher (sectionAdvisory, t_firstname, t_middlename, t_lastname, t_suffix, t_dob, t_age, t_email, t_contact, t_birthplace, t_gender, t_civilstatus, t_occupation, t_religion, t_house_no, t_street_name, t_purok, t_zone, t_barangay, t_municipality, t_province, t_region, t_image, t_date_registered) VALUES ('$section', '$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$date_registered')");

              	  if($save) {
		          	$_SESSION['message'] = "Record has been saved!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: teacher_mgmt.php?page=create");
		          } else {
		            $_SESSION['message'] = "Something went wrong while saving the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: teacher_mgmt.php?page=create");
		          }
	       			
	        } else {
	        	$_SESSION['message'] = "There was an error uploading your profile picture.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: teacher_mgmt.php?page=create");
	        }
		  }
		}
	}




	// ENROLL STUDENT - USERS_ENROLL.PHP
	if(isset($_POST['enroll_student'])) {
		$user_Id       = $_POST['user_Id'];
		$section       = $_POST['section'];
		$teacher       = $_POST['teacher'];
		$date_enrolled = date('Y-m-d');

		$fetch = mysqli_query($conn, "SELECT * FROM enrollment WHERE section_Id='$section'");
		if(mysqli_num_rows($fetch) > 40) {
			$_SESSION['message'] = "This section is already full.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: users.php");
		} else {
			$fetch = mysqli_query($conn, "SELECT * FROM enrollment WHERE student_Id='$user_Id' AND date_enrolled='$date_enrolled'");
			if(mysqli_num_rows($fetch) > 0) {
				$_SESSION['message'] = "This student is already enrolled.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: users.php");
			} else {
				$save = mysqli_query($conn, "INSERT INTO enrollment (student_Id, section_Id, teacher_Id, date_enrolled) VALUES ('$user_Id', '$section', '$teacher', '$date_enrolled')");
				  if($save) {
				  	$update = mysqli_query($conn, "UPDATE users SET user_status=1 WHERE user_Id='$user_Id'");
				  	  if($update) {
					  	$_SESSION['message'] = "Student is successfully enrolled!";
			            $_SESSION['text'] = "Enrolled successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users.php");
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating user status to enroll status.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users.php");
			          }
		          } else {
		            $_SESSION['message'] = "Something went wrong while enrolling student.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users.php");
		          }

			}

		}

	}

	






	// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
	if(isset($_POST['sendEmail'])) {

		$name    = mysqli_real_escape_string($conn, $_POST['name']);
		$email	 = mysqli_real_escape_string($conn, $_POST['email']);
		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$msg     = mysqli_real_escape_string($conn, $_POST['message']);

	    $message = '<h3>'.$subject.'</h3>
					<p>
						Good day!<br>
						'.$msg.'
					</p>
					<p>
						Name of Sender: '.$name.'<br>
						Email: '.$email.'
					</p>
					<p><b>Note:</b> This is a system generated email please do not reply.</p>';
					//Load composer's autoloader

			    $mail = new PHPMailer(true);                            
			    try {
			        //Server settings
			        $mail->isSMTP();                                     
			        $mail->Host = 'smtp.gmail.com';                      
			        $mail->SMTPAuth = true;                             
			        $mail->Username = 'nhsmedellin@gmail.com';     
	        		$mail->Password = 'fgzyhjjhjxdikkjp';                
			        $mail->SMTPOptions = array(
			            'ssl' => array(
			            'verify_peer' => false,
			            'verify_peer_name' => false,
			            'allow_self_signed' => true
			            )
			        );                         
			        $mail->SMTPSecure = 'ssl';                           
			        $mail->Port = 465;                                   

			        //Send Email
			        $mail->setFrom('nhsmedellin@gmail.com');
			        
			        //Recipients
			        $mail->addAddress('sonerwin12@gmail.com');              
			        $mail->addReplyTo('sonesrwin12@gmail.com');
			        
			        //Content
			        $mail->isHTML(true);                                  
			        $mail->Subject = $subject;
			        $mail->Body    = $message;

			        $mail->send();
					$_SESSION['success'] = "Email sent successfully!";
					header("Location: contact-us.php");

			    } catch (Exception $e) {
			    	$_SESSION['success'] = "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
					header("Location: contact-us.php");
			    }
    }
	

?>



