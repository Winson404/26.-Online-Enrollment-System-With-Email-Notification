<?php 
	include '../config.php';

		
	// UPDATE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['update_admin'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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
		$file             = basename($_FILES["fileToUpload"]["name"]);

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];

		if(empty($file)) {
			if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: admin_mgmt.php?page=".$user_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: admin_mgmt.php?page=".$user_Id);
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          }
				}
			}

		} else {

			if($existing_email == $email) {

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
					header("Location: admin_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "File must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: admin_mgmt.php?page=".$user_Id);

				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=".$user_Id);
			          }
						
					} else {
						$_SESSION['message'] = "There was an error uploading your profile picture.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: admin_mgmt.php?page=".$user_Id);
					}
				}

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: admin_mgmt.php?page=".$user_Id);
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
							header("Location: admin_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						} 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "File must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);
							$uploadOk = 0;
						}

						// Allow certain file formats
						elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
						}

						// Check if $uploadOk is set to 0 by an error
						elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: admin_mgmt.php?page=".$user_Id);

						// if everything is ok, try to upload file
						} else {

							if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

							 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");

			              	  if($update) {
					          	$_SESSION['message'] = "Record has been updated!";
					            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
								header("Location: admin_mgmt.php?page=".$user_Id);
					          } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: admin_mgmt.php?page=".$user_Id);
					          }
								
							} else {
								$_SESSION['message'] = "There was an error uploading your profile picture.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: admin_mgmt.php?page=".$user_Id);
							}
						}
				}
			}
		}
	}





	// CHANGE ADMIN PASSWORD - ADMIN_DELETE.PHP
	if(isset($_POST['password_admin'])) {

    	$user_Id     = $_POST['user_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
			// COMPARE BOTH NEW AND CONFIRM PASSWORD
    		if($password != $cpassword) {
				$_SESSION['message']  = "Password did not matched. Please try again";
            	$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: admin.php");
    		} else {
    			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
    			if($update_password) {
        			$_SESSION['message'] = "Password has been changed.";
	           	    $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: admin.php");
                } else {
          			$_SESSION['message'] = "Something went wrong while changing the password.";
            		$_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: admin.php");
                }
    		}
    	} else {
			$_SESSION['message']  = "Old password is incorrect.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: admin.php");
    	}
    }





    // UPDATE USER - USERS_MGMT.PHP
	if(isset($_POST['update_user'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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
		$guardianName 	  = mysqli_real_escape_string($conn, $_POST['guardianName']);
		$guardianContact  = mysqli_real_escape_string($conn, $_POST['guardianContact']);
		$schoolName       = mysqli_real_escape_string($conn, $_POST['schoolName']);
		$schoolAddress    = mysqli_real_escape_string($conn, $_POST['schoolAddress']);
		$yearLevel        = mysqli_real_escape_string($conn, $_POST['yearLevel']);
		$file             = basename($_FILES["fileToUpload"]["name"]);
		$certificate 	  = basename($_FILES["certificate"]["name"]);

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];


		if(empty($file) AND empty($certificate)) {

			if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: users_mgmt.php?page=".$user_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: users_mgmt.php?page=".$user_Id);
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
			          }
				}
			}

		} elseif(empty($file) AND !empty($certificate)) {

			if($existing_email == $email) {

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
					header("Location: users_mgmt.php?page=".$user_Id);
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["certificate"]["size"] > 500000) {
				  	$_SESSION['message']  = "Document must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
			    }

			    // Check if $uploadOk is set to 0 by an error
			    elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);

			    // if everything is ok, try to upload file
			    } else {

		        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

	        		$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', document='$certificate', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
			          }
		       			
		        } else {
		        	$_SESSION['message'] = "There was an error uploading your document.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
		        }
			  }

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: users_mgmt.php?page=".$user_Id);
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
							header("Location: users_mgmt.php?page=".$user_Id);
					    	$uploadOk = 0;
					    } 

						// Check file size // 500KB max size
						elseif ($_FILES["certificate"]["size"] > 500000) {
						  	$_SESSION['message']  = "Document must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
					    	$uploadOk = 0;
						}

					    // Allow certain file formats
					    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
					    }

					    // Check if $uploadOk is set to 0 by an error
					    elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);

					    // if everything is ok, try to upload file
					    } else {

				        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

			        		$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', document='$certificate', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

			              	  if($update) {
					          	$_SESSION['message'] = "Record has been updated!";
					            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
								header("Location: users_mgmt.php?page=".$user_Id);
					          } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);
					          }
				       			
				        } else {
				        	$_SESSION['message'] = "There was an error uploading your document.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=create");
				        }
					  }
				}
			}

		} elseif(!empty($file) AND empty($certificate)) {

			if($existing_email == $email) {

				// Check if image file is a actual image or fake image
			    $target_dir = "../images-users/";
			    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			    $uploadOk = 1;
			    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "Document is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "Document must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
			    }

			    // Check if $uploadOk is set to 0 by an error
			    elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);

			    // if everything is ok, try to upload file
			    } else {

		        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

	        		$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users_mgmt.php?page=".$user_Id);
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
			          }
		       			
		        } else {
		        	$_SESSION['message'] = "There was an error uploading your profile picture.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=create");
		        }
			  }

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: users_mgmt.php?page=".$user_Id);
				} else {
					  	// Check if image file is a actual image or fake image
					    $target_dir = "../images-users/";
					    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					    $uploadOk = 1;
					    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


					    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "Document is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
					    	$uploadOk = 0;
					    } 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "Document must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
					    	$uploadOk = 0;
						}

					    // Allow certain file formats
					    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
					    }

					    // Check if $uploadOk is set to 0 by an error
					    elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);

					    // if everything is ok, try to upload file
					    } else {

				        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

			        		$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

			              	  if($update) {
					          	$_SESSION['message'] = "Record has been updated!";
					            $_SESSION['text'] = "Saved successfully!";
						        $_SESSION['status'] = "success";
								header("Location: users_mgmt.php?page=".$user_Id);
					          } else {
					            $_SESSION['message'] = "Something went wrong while updating the information.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);
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

		} else {

			if($existing_email == $email) {

				// Check if image file is a actual image or fake image
			    $target_dir = "../images-users/";
			    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			    $uploadOk = 1;
			    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    $_SESSION['message']  = "Document is not an image.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
			    	$uploadOk = 0;
			    } 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				  	$_SESSION['message']  = "Document must be up to 500KB in size.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
			    	$uploadOk = 0;
				}

			    // Allow certain file formats
			    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);
				    $uploadOk = 0;
			    }

			    // Check if $uploadOk is set to 0 by an error
			    elseif ($uploadOk == 0) {
				    $_SESSION['message'] = "Your file was not uploaded.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: users_mgmt.php?page=".$user_Id);

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
						header("Location: users_mgmt.php?page=".$user_Id);
				    	$uploadOk = 0;
				    } 

					// Check file size // 500KB max size
					elseif ($_FILES["certificate"]["size"] > 500000) {
					  	$_SESSION['message']  = "Document must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
				    	$uploadOk = 0;
					}

				    // Allow certain file formats
				    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);
					    $uploadOk = 0;
				    }

				    // Check if $uploadOk is set to 0 by an error
				    elseif ($uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: users_mgmt.php?page=".$user_Id);

				    // if everything is ok, try to upload file
				    } else {

			        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

		        		$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file', document='$certificate', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

		              	  if($update) {
				          	$_SESSION['message'] = "Record has been updated!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: users_mgmt.php?page=".$user_Id);
				          } else {
				            $_SESSION['message'] = "Something went wrong while updating the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
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

		

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: users_mgmt.php?page=".$user_Id);
				} else {
						// Check if image file is a actual image or fake image
					    $target_dir = "../images-users/";
					    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					    $uploadOk = 1;
					    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


					    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
						if($check == false) {
						    $_SESSION['message']  = "Document is not an image.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
					    	$uploadOk = 0;
					    } 

						// Check file size // 500KB max size
						elseif ($_FILES["fileToUpload"]["size"] > 500000) {
						  	$_SESSION['message']  = "Document must be up to 500KB in size.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
					    	$uploadOk = 0;
						}

					    // Allow certain file formats
					    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
						    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);
						    $uploadOk = 0;
					    }

					    // Check if $uploadOk is set to 0 by an error
					    elseif ($uploadOk == 0) {
						    $_SESSION['message'] = "Your file was not uploaded.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: users_mgmt.php?page=".$user_Id);

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
								header("Location: users_mgmt.php?page=".$user_Id);
						    	$uploadOk = 0;
						    } 

							// Check file size // 500KB max size
							elseif ($_FILES["certificate"]["size"] > 500000) {
							  	$_SESSION['message']  = "Document must be up to 500KB in size.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);
						    	$uploadOk = 0;
							}

						    // Allow certain file formats
						    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
							    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);
							    $uploadOk = 0;
						    }

						    // Check if $uploadOk is set to 0 by an error
						    elseif ($uploadOk == 0) {
							    $_SESSION['message'] = "Your file was not uploaded.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: users_mgmt.php?page=".$user_Id);

						    // if everything is ok, try to upload file
						    } else {

					        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {

				        		$update = mysqli_query($conn, "UPDATE users SET enrollmentType='$enrollmentType', firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', nationality='$nationality', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file', document='$certificate', guardianName='$guardianName', guardianContact='$guardianContact', schoolName='$schoolName', schoolAddress='$schoolAddress', yearLevel='$yearLevel' WHERE user_Id='$user_Id' ");

				              	  if($update) {
						          	$_SESSION['message'] = "Record has been updated!";
						            $_SESSION['text'] = "Saved successfully!";
							        $_SESSION['status'] = "success";
									header("Location: users_mgmt.php?page=".$user_Id);
						          } else {
						            $_SESSION['message'] = "Something went wrong while updating the information.";
						            $_SESSION['text'] = "Please try again.";
							        $_SESSION['status'] = "error";
									header("Location: users_mgmt.php?page=".$user_Id);
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
		
	}





	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if(isset($_POST['password_user'])) {

    	$user_Id     = $_POST['user_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
			// COMPARE BOTH NEW AND CONFIRM PASSWORD
    		if($password != $cpassword) {
				$_SESSION['message']  = "Password did not matched. Please try again";
            	$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: users.php");
    		} else {
    			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
    			if($update_password) {
        			$_SESSION['message'] = "Password has been changed.";
	           	    $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: users.php");
                } else {
          			$_SESSION['message'] = "Something went wrong while changing the password.";
            		$_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users.php");
                }
    		}
    	} else {
			$_SESSION['message']  = "Old password is incorrect.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: users.php");
    	}
    }






    // UPDATE STUDENT DOCUMENTS - USERS_DOCUMENT.PHP
	if(isset($_POST['updateDocument'])) {

		$user_Id  = $_POST['user_Id'];
		$certificate  = basename($_FILES["certificate"]["name"]);

		  // Check if image file is a actual image or fake image
		    $target_dir = "../images-document/";
		    $target_file = $target_dir . basename($_FILES["certificate"]["name"]);
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		    $check = getimagesize($_FILES["certificate"]["tmp_name"]);
			if($check == false) {
			    $_SESSION['message']  = "Selected file is not an image.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users_document.php?user_Id=".$user_Id);
		    	$uploadOk = 0;
		    } 

			// Check file size // 500KB max size
			elseif ($_FILES["certificate"]["size"] > 500000) {
			  	$_SESSION['message']  = "File must be up to 500KB in size.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users_document.php?user_Id=".$user_Id);
		    	$uploadOk = 0;
			}

		    // Allow certain file formats
		    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			    $_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users_document.php?user_Id=".$user_Id);
		    	$uploadOk = 0;
		    }

		    // Check if $uploadOk is set to 0 by an error
		    elseif ($uploadOk == 0) {
			    $_SESSION['message']  = "Your file was not uploaded.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: users_document.php?user_Id=".$user_Id);

		    // if everything is ok, try to upload file
		    } else {

		        if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $target_file)) {
		          	$save = mysqli_query($conn, "UPDATE users SET document='$certificate' WHERE user_Id='$user_Id'");
		     
		            if($save) {
		            	$_SESSION['message'] = "Document has been updated!";
			            $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
						header("Location: users_document.php?user_Id=".$user_Id);
		            } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: users_document.php?user_Id=".$user_Id);
		            }
		        } else {
		            $_SESSION['message'] = "There was an error uploading your file.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: users_document.php?user_Id=".$user_Id);
		        }

			}
	}






	// UPDATE ADMIN INFO - PROFILE.PHP
	if(isset($_POST['update_profile_info'])) {

		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
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

		$get_email = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['email'];

		if($existing_email == $email) {

				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: profile.php");
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: profile.php");
		          }

			} else {
				$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: profile.php");
				} else {
					  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

	              	  if($update) {
			          	$_SESSION['message'] = "Record has been updated!";
			            $_SESSION['text'] = "Saved successfully!";
				        $_SESSION['status'] = "success";
						header("Location: profile.php");
			          } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: profile.php");
			          }
				}
			}
	}



	// CHANGE ADMIN PASSWORD - PROFILE.PHP
	if(isset($_POST['update_password_admin'])) {

    	$user_Id    = $_POST['user_Id'];
    	$OldPassword = md5($_POST['OldPassword']);
    	$password    = md5($_POST['password']);
    	$cpassword   = md5($_POST['cpassword']);

    	$check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

    	// CHECK IF THERE IS MATCHED PASSWORD IN THE DATABASE COMPARED TO THE ENTERED OLD PASSWORD
    	if(mysqli_num_rows($check_old_password) === 1 ) {
			// COMPARE BOTH NEW AND CONFIRM PASSWORD
    		if($password != $cpassword) {
				$_SESSION['message']  = "Password does not matched. Please try again";
            	$_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: profile.php");
    		} else {
    			$update_password = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id' ");
    			if($update_password) {
                	$_SESSION['message'] = "Password has been changed.";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: profile.php");
                } else {
                    $_SESSION['message'] = "Something went wrong while changing the password.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: profile.php");
                }
    		}
    	} else {
			$_SESSION['message']  = "Old password is incorrect.";
            $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: profile.php");
    	}

    }




  	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if(isset($_POST['update_profile_admin'])) {

		$user_Id    = $_POST['user_Id'];
		$file       = basename($_FILES["fileToUpload"]["name"]);

		  // Check if image file is a actual image or fake image
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check == false) {
		    $_SESSION['message']  = "Selected file is not an image.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");
	    	$uploadOk = 0;
	    } 

		// Check file size // 500KB max size
		elseif ($_FILES["fileToUpload"]["size"] > 500000) {
		  	$_SESSION['message']  = "File must be up to 500KB in size.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");
	    	$uploadOk = 0;
		}

	    // Allow certain file formats
	    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
		    $_SESSION['message']  = "Only JPG, JPEG, PNG & GIF files are allowed.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");
	    	$uploadOk = 0;
	    }

	    // Check if $uploadOk is set to 0 by an error
	    elseif ($uploadOk == 0) {
		    $_SESSION['message']  = "Your file was not uploaded.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: profile.php");

	    // if everything is ok, try to upload file
	    } else {

	        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	          	$save = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	     
	            if($save) {
	            	$_SESSION['message'] = "Profile picture has been updated!";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: profile.php");
	            } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: profile.php");
	            }
	        } else {
	            $_SESSION['message'] = "There was an error uploading your file.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: profile.php");
	        }

		}
	}




	// UPDATE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['update_customization'])) {
		$customID = $_POST['customID'];
		$file     = basename($_FILES["fileToUpload"]["name"]);
		
		$exist = mysqli_query($conn, "SELECT * FROM customization WHERE customID='$customID'");	
		$row = mysqli_fetch_array($exist);
		if($file == $row['picture']) {
			$_SESSION['message'] = "Image is still the same.";
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
			    $_SESSION['message']  = "Signature file is not an image.";
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
					$update = mysqli_query($conn, "UPDATE customization SET picture='$file' WHERE customID='$customID' ");
					if($update) {
			        	$_SESSION['message'] = "Image customization has been updated!";
			            $_SESSION['text'] = "Updated successfully!";
				        $_SESSION['status'] = "success";
						header("Location: customize.php");
			        } else {
			            $_SESSION['message'] = "Something went wrong while updating the information.";
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




	// SET ACTIVE - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['setActive_customization'])) {

		$customID = $_POST['customID'];

		$exist = mysqli_query($conn, "SELECT * FROM customization WHERE status='Active' ");
		
		if(mysqli_num_rows($exist) > 0) {
			$update = mysqli_query($conn, "UPDATE customization SET status='Inactive'");
			if($update) {
				$update2 = mysqli_query($conn, "UPDATE customization SET status='Active' WHERE customID='$customID'");
	        	if($update2) {
	        		$_SESSION['message'] = "Image is now Active.";
		            $_SESSION['text'] = "Updated successfully!";
			        $_SESSION['status'] = "success";
					header("Location: customize.php");
				} else {
					$_SESSION['message'] = "Something went wrong while settings the image as Active.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: customize.php");
				}
	        } else {
	            $_SESSION['message'] = "Something went wrong while settings the image as Active.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: customize.php");
	        }  
		} else {
			$update2 = mysqli_query($conn, "UPDATE customization SET status='Active' WHERE customID='$customID'");
	    	if($update2) {
	    		$_SESSION['message'] = "Image is now Active.";
	            $_SESSION['text'] = "Updated successfully!";
		        $_SESSION['status'] = "success";
				header("Location: customize.php");
			} else {
				$_SESSION['message'] = "Something went wrong while settings the image as Active.";
	            $_SESSION['text'] = "Please try again.";
		        $_SESSION['status'] = "error";
				header("Location: customize.php");
			}
		}
	}




	// UPDATE ACTIVITIY - ACTIVITY_UPDATE_DELETE.PHP
	if(isset($_POST['update_activity'])) {
		$actId 			= $_POST['actId'];
		$activity       = $_POST['activity'];
		$actDate        = $_POST['actDate'];
		$date_acquired  = date('Y-m-d');
		$update = mysqli_query($conn, "UPDATE announcement SET actName='$activity', actDate='$actDate' WHERE actId='$actId'");

		  if($update) {
		  	$_SESSION['message'] = "Announcement has been updated.";
		    $_SESSION['text'] = "Updated successfully!";
		    $_SESSION['status'] = "success";
			header("Location: announcement.php");
		  } else {
		    $_SESSION['message'] = "Something went wrong while saving the information.";
		    $_SESSION['text'] = "Please try again.";
		    $_SESSION['status'] = "error";
			header("Location: announcement.php");
		  }
	}



	// UPDATE SECTION - SECTION_UPDATE_DELETE.PHP
	if(isset($_POST['update_section'])) {
		$sectionId = $_POST['sectionId'];
		$section   = $_POST['section'];
		$yearLevel = $_POST['yearLevel'];

		$fetch = mysqli_query($conn, "SELECT * FROM section WHERE sectionName='$section' AND yearLevel='$yearLevel' AND sectionId='$sectionId'");
		if(mysqli_num_rows($fetch) > 0) {
			$update = mysqli_query($conn, "UPDATE section SET sectionName='$section', yearLevel='$yearLevel' WHERE sectionId='$sectionId'");
			  if($update) {
			  	$_SESSION['message'] = "Section has been updated.";
			    $_SESSION['text'] = "Updated successfully!";
			    $_SESSION['status'] = "success";
				header("Location: section.php");
			  } else {
			    $_SESSION['message'] = "Something went wrong while updating the information.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: section.php");
			  }
		} else {
			$fetch = mysqli_query($conn, "SELECT * FROM section WHERE sectionName='$section' AND yearLevel='$yearLevel'");
			if(mysqli_num_rows($fetch) > 0) {
				$_SESSION['message'] = "Section already exists.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: section.php");
			} else {
				 $update = mysqli_query($conn, "UPDATE section SET sectionName='$section', yearLevel='$yearLevel' WHERE sectionId='$sectionId'");
				  if($update) {
				  	$_SESSION['message'] = "Section has been updated.";
				    $_SESSION['text'] = "Updated successfully!";
				    $_SESSION['status'] = "success";
					header("Location: section.php");
				  } else {
				    $_SESSION['message'] = "Something went wrong while updating the information.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: section.php");
				  }
			}
		}
		
	}




	// UPDATE SUBJECT - SUBJECT_MGMT.PHP
	if(isset($_POST['update_subject'])) {
		$subjectId   = $_POST['subjectId'];
		$section     = $_POST['section'];
		$subject     = $_POST['subject'];
		$subjectTime = $_POST['subjectTime'];

		$fetch = mysqli_query($conn, "SELECT * FROM subject WHERE sectionId='$section' AND subjectName='$subject' AND subjectTime='$subjectTime' AND subjectId='$subjectId'");
		if(mysqli_num_rows($fetch) > 0) {
			$update = mysqli_query($conn, "UPDATE subject SET sectionId='$section', subjectName='$subject', subjectTime='$subjectTime' WHERE subjectId='$subjectId'");
			  if($update) {
			  	$_SESSION['message'] = "Subject has been updated.";
			    $_SESSION['text'] = "Updated successfully!";
			    $_SESSION['status'] = "success";
				header("Location: subject_mgmt.php?page=".$subjectId);
			  } else {
			    $_SESSION['message'] = "Something went wrong while updating the information.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: subject_mgmt.php?page=".$subjectId);
			  }
		} else {
			$fetch = mysqli_query($conn, "SELECT * FROM subject WHERE sectionId='$section' AND subjectName='$subject' AND subjectTime='$subjectTime'");
			if(mysqli_num_rows($fetch) > 0) {
				$_SESSION['message'] = "Subject already exists.";
			    $_SESSION['text'] = "Please try again.";
			    $_SESSION['status'] = "error";
				header("Location: subject_mgmt.php?page=".$subjectId);
			} else {
				 $update = mysqli_query($conn, "UPDATE subject SET sectionId='$section', subjectName='$subject', subjectTime='$subjectTime' WHERE subjectId='$subjectId'");
				  if($update) {
				  	$_SESSION['message'] = "Subject has been updated.";
				    $_SESSION['text'] = "Updated successfully!";
				    $_SESSION['status'] = "success";
					header("Location: subject_mgmt.php?page=".$subjectId);
				  } else {
				    $_SESSION['message'] = "Something went wrong while updating the information.";
				    $_SESSION['text'] = "Please try again.";
				    $_SESSION['status'] = "error";
					header("Location: subject_mgmt.php?page=".$subjectId);
				  }
			}
		}
		
	}







	// UPDATE TEACHER - TEACHER_MGMT.PHP
	if(isset($_POST['update_teacher'])) {

		$teacher_Id		  = mysqli_real_escape_string($conn, $_POST['teacher_Id']);
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

		$get_email = mysqli_query($conn, "SELECT * FROM teacher WHERE teacher_Id='$teacher_Id'");
		$row = mysqli_fetch_array($get_email);
		$existing_email = $row['t_email'];

		if(empty($file)) {
			if($existing_email == $email) {
				$getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section' AND teacher_Id='$teacher_Id'");
				if(mysqli_num_rows($getsection) > 0) {
					$update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section' WHERE teacher_Id='$teacher_Id' ");

              	  if($update) {
		          	$_SESSION['message'] = "Record has been updated!";
		            $_SESSION['text'] = "Saved successfully!";
			        $_SESSION['status'] = "success";
					header("Location: teacher_mgmt.php?page=".$teacher_Id);
		          } else {
		            $_SESSION['message'] = "Something went wrong while updating the information.";
		            $_SESSION['text'] = "Please try again.";
			        $_SESSION['status'] = "error";
					header("Location: teacher_mgmt.php?page=".$teacher_Id);
		          }
				} else {
					$getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section'");
					if(mysqli_num_rows($getsection) > 0) {
						$_SESSION['message'] = "This section has already been assigned to other teacher.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: teacher_mgmt.php?page=".$teacher_Id);
					} else {
						 $update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section' WHERE teacher_Id='$teacher_Id' ");

		              	  if($update) {
				          	$_SESSION['message'] = "Record has been updated!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          } else {
				            $_SESSION['message'] = "Something went wrong while updating the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          }
					}
				}

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: teacher_mgmt.php?page=".$teacher_Id);
				} else {
					  $getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section' AND teacher_Id='$teacher_Id'");
						if(mysqli_num_rows($getsection) > 0) {
							$update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section' WHERE teacher_Id='$teacher_Id' ");

		              	  if($update) {
				          	$_SESSION['message'] = "Record has been updated!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          } else {
				            $_SESSION['message'] = "Something went wrong while updating the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          }
						} else {
							$getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section'");
							if(mysqli_num_rows($getsection) > 0) {
								$_SESSION['message'] = "This section has already been assigned to other teacher.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: teacher_mgmt.php?page=".$teacher_Id);
							} else {
								 $update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section' WHERE teacher_Id='$teacher_Id' ");

				              	  if($update) {
						          	$_SESSION['message'] = "Record has been updated!";
						            $_SESSION['text'] = "Saved successfully!";
							        $_SESSION['status'] = "success";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
						          } else {
						            $_SESSION['message'] = "Something went wrong while updating the information.";
						            $_SESSION['text'] = "Please try again.";
							        $_SESSION['status'] = "error";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
						          }
							}
						}
				}
			}

		} else {

			if($existing_email == $email) {

				$getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section' AND teacher_Id='$teacher_Id'");
				if(mysqli_num_rows($getsection) > 0) {
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
						header("Location: teacher_mgmt.php?page=".$teacher_Id);
						$uploadOk = 0;
					} 

					// Check file size // 500KB max size
					elseif ($_FILES["fileToUpload"]["size"] > 500000) {
					  	$_SESSION['message']  = "File must be up to 500KB in size.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: teacher_mgmt.php?page=".$teacher_Id);
						$uploadOk = 0;
					}

					// Allow certain file formats
					elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: teacher_mgmt.php?page=".$teacher_Id);
					    $uploadOk = 0;
					}

					// Check if $uploadOk is set to 0 by an error
					elseif ($uploadOk == 0) {
					    $_SESSION['message'] = "Your file was not uploaded.";
					    $_SESSION['text'] = "Please try again.";
					    $_SESSION['status'] = "error";
						header("Location: teacher_mgmt.php?page=".$teacher_Id);

					// if everything is ok, try to upload file
					} else {

						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

						 $update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section', image='$file' WHERE teacher_Id='$teacher_Id' ");

		              	  if($update) {
				          	$_SESSION['message'] = "Record has been updated!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          } else {
				            $_SESSION['message'] = "Something went wrong while updating the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          }
							
						} else {
							$_SESSION['message'] = "There was an error uploading your profile picture.";
						    $_SESSION['text'] = "Please try again.";
						    $_SESSION['status'] = "error";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
						}
					}
				} else {
					$getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section'");
					if(mysqli_num_rows($getsection) > 0) {
						$_SESSION['message'] = "This section has already been assigned to other teacher.";
			            $_SESSION['text'] = "Please try again.";
				        $_SESSION['status'] = "error";
						header("Location: teacher_mgmt.php?page=".$teacher_Id);
					} else {
						 $update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section', image='$file' WHERE teacher_Id='$teacher_Id' ");

		              	  if($update) {
				          	$_SESSION['message'] = "Record has been updated!";
				            $_SESSION['text'] = "Saved successfully!";
					        $_SESSION['status'] = "success";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          } else {
				            $_SESSION['message'] = "Something went wrong while updating the information.";
				            $_SESSION['text'] = "Please try again.";
					        $_SESSION['status'] = "error";
							header("Location: teacher_mgmt.php?page=".$teacher_Id);
				          }
					}
				}

				

				

			} else {
				$check = mysqli_query($conn, "SELECT * FROM teacher WHERE email='$email'");
				if(mysqli_num_rows($check) > 0) {
				   $_SESSION['message'] = "Email already exists!";
			       $_SESSION['text'] = "Please try again.";
			       $_SESSION['status'] = "error";
				   header("Location: admin_mgmt.php?page=".$user_Id);
				} else {
					    $getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section' AND teacher_Id='$teacher_Id'");
						if(mysqli_num_rows($getsection) > 0) {
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
								header("Location: teacher_mgmt.php?page=".$teacher_Id);
								$uploadOk = 0;
							} 

							// Check file size // 500KB max size
							elseif ($_FILES["fileToUpload"]["size"] > 500000) {
							  	$_SESSION['message']  = "File must be up to 500KB in size.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: teacher_mgmt.php?page=".$teacher_Id);
								$uploadOk = 0;
							}

							// Allow certain file formats
							elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
							    $_SESSION['message'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: teacher_mgmt.php?page=".$teacher_Id);
							    $uploadOk = 0;
							}

							// Check if $uploadOk is set to 0 by an error
							elseif ($uploadOk == 0) {
							    $_SESSION['message'] = "Your file was not uploaded.";
							    $_SESSION['text'] = "Please try again.";
							    $_SESSION['status'] = "error";
								header("Location: teacher_mgmt.php?page=".$teacher_Id);

							// if everything is ok, try to upload file
							} else {

								if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

								 $update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section', image='$file' WHERE teacher_Id='$teacher_Id' ");

				              	  if($update) {
						          	$_SESSION['message'] = "Record has been updated!";
						            $_SESSION['text'] = "Saved successfully!";
							        $_SESSION['status'] = "success";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
						          } else {
						            $_SESSION['message'] = "Something went wrong while updating the information.";
						            $_SESSION['text'] = "Please try again.";
							        $_SESSION['status'] = "error";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
						          }
									
								} else {
									$_SESSION['message'] = "There was an error uploading your profile picture.";
								    $_SESSION['text'] = "Please try again.";
								    $_SESSION['status'] = "error";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
								}
							}
						} else {
							$getsection = mysqli_query($conn, "SELECT * FROM teacher WHERE sectionAdvisory='$section'");
							if(mysqli_num_rows($getsection) > 0) {
								$_SESSION['message'] = "This section has already been assigned to other teacher.";
					            $_SESSION['text'] = "Please try again.";
						        $_SESSION['status'] = "error";
								header("Location: teacher_mgmt.php?page=".$teacher_Id);
							} else {
								 $update = mysqli_query($conn, "UPDATE teacher SET t_firstname='$firstname', t_middlename='$middlename', t_lastname='$lastname', t_suffix='$suffix', t_dob='$dob', t_age='$age', t_email='$email', t_contact='$contact', t_birthplace='$birthplace', t_gender='$gender', t_civilstatus='$civilstatus', t_occupation='$occupation', t_religion='$religion', t_house_no='$house_no', t_street_name='$street_name', t_purok='$purok', t_zone='$zone', t_barangay='$barangay', t_municipality='$municipality', t_province='$province', t_region='$region', sectionAdvisory='$section', image='$file' WHERE teacher_Id='$teacher_Id' ");

				              	  if($update) {
						          	$_SESSION['message'] = "Record has been updated!";
						            $_SESSION['text'] = "Saved successfully!";
							        $_SESSION['status'] = "success";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
						          } else {
						            $_SESSION['message'] = "Something went wrong while updating the information.";
						            $_SESSION['text'] = "Please try again.";
							        $_SESSION['status'] = "error";
									header("Location: teacher_mgmt.php?page=".$teacher_Id);
						          }
							}
						}
				}
			}
		}
	}






?>
