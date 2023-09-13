<?php 
	include '../config.php';

	// DELETE ADMIN - ADMIN_DELETE.PHP
	if(isset($_POST['delete_admin'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "System User has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: admin.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: admin.php");
	      }
	}


	// DELETE USER - USERS_DELETE.PHP
	if(isset($_POST['delete_user'])) {
		$user_Id = $_POST['user_Id'];

		$delete = mysqli_query($conn, "DELETE FROM users WHERE user_Id='$user_Id'");
		if($delete) {
	      	$_SESSION['message'] = "Student record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: users.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: users.php");
	      }
	}
	

	// DELETE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if(isset($_POST['delete_customization'])) {
		$customID = $_POST['customID'];

		$delete = mysqli_query($conn, "DELETE FROM customization WHERE customID='$customID'");
		 if($delete) {
	      	$_SESSION['message'] = "Cutomization image has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: customize.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: customize.php");
	      }
	}


	// DELETE ACTIVITY - ACTIVITY_UPDATE_DELETE.PHP
	if(isset($_POST['delete_activity'])) {
		$actId = $_POST['actId'];

		$delete = mysqli_query($conn, "DELETE FROM announcement WHERE actId='$actId'");
		 if($delete) {
	      	$_SESSION['message'] = "Announcement has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: announcement.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: announcement.php");
	      }
	}


	// DELETE SECTION - SECTION_UPDATE_DELETE.PHP
	if(isset($_POST['delete_section'])) {
		$sectionId = $_POST['sectionId'];

		$delete = mysqli_query($conn, "DELETE FROM section WHERE sectionId='$sectionId'");
		 if($delete) {
	      	$_SESSION['message'] = "Section has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: section.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: section.php");
	      }
	}



	// DELETE SUBJECT - SUBJECT_UPDATE_DELETE.PHP
	if(isset($_POST['delete_subject'])) {
		$subjectId = $_POST['subjectId'];

		$delete = mysqli_query($conn, "DELETE FROM subject WHERE subjectId='$subjectId'");
		 if($delete) {
	      	$_SESSION['message'] = "Subject has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: subject.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: subject.php");
	      }
	}



	// DELETE TEACHER - TEACHER_UPDATE_DELETE.PHP
	if(isset($_POST['delete_teacher'])) {
		$teacher_Id = $_POST['teacher_Id'];

		$delete = mysqli_query($conn, "DELETE FROM teacher WHERE teacher_Id='$teacher_Id'");
		 if($delete) {
	      	$_SESSION['message'] = "Teacher record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
			header("Location: teacher.php");
	      } else {
	        $_SESSION['message'] = "Something went wrong while deleting the record";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
			header("Location: teacher.php");
	      }
	}






?>




