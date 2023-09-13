<?php

include("../config.php");
include("XLSXLibrary.php");

if(isset($_GET['yearLevel'])) {

  $yearLevel = $_GET['yearLevel'];


  $student = [
        ['No.', 'Enrollment type', 'Year level', 'Full name', 'Date of birth', 'Age', 'Birthplace', 'Gender', 'Civil status', 'Occupation', 'Religion', 'Nationality', 'Email', 'Contact no', 'Address', 'Name of Guardian', 'Guardian contact numuber', 'Name of School', 'School address', 'Enrollment Status', 'Date registered']
      ];

      $id = 0;
      $sql = "SELECT * FROM users WHERE yearLevel='$yearLevel' ORDER BY lastname";
      $res = mysqli_query($conn, $sql);
      if (mysqli_num_rows($res) > 0) {
        foreach ($res as $row) {
          $id++;
          $name = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
          $enrollmentStatus = '';
          if($row['user_status'] == 0) {
            $enrollmentStatus = 'Pending';
          } else {
            $enrollmentStatus = 'Officially enrolled';   
          }
          $address = $row['house_no']. ' ' .$row['street_name']. ', ' .$row['purok']. ' ' .$row['zone']. ' ' .$row['barangay']. ', ' .$row['municipality']. ', ' .$row['province']. ' ' .$row['region'];
          $student = array_merge($student, array(array($id, $row['enrollmentType'], $row['yearLevel'], $name, date("F d, Y", strtotime($row['dob'])), $row['age'], $row['birthplace'], $row['gender'], $row['civilstatus'], $row['occupation'], $row['religion'], $row['nationality'], $row['email'], $row['contact'], $address, $row['guardianName'], $row['guardianContact'], $row['schoolName'], $row['schoolAddress'], $enrollmentStatus, date("F d, Y", strtotime($row['date_registered'])))));
        }
      } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: users.php");
      }

      $xlsx = SimpleXLSXGen::fromArray($student);
      $xlsx->downloadAs('Student records.xlsx'); // This will download the file to your local system

      // $xlsx->saveAs('student.xlsx'); // This will save the file to your server

      echo "<pre>";

      print_r($student);

      header('Location: users.php');


}







if(isset($_GET['enrolled'])) {

  $sectionId = $_GET['enrolled'];

  $student = [
        ['No.', 'Enrollment type', 'Student name', 'Section Enrolled', 'Adviser', 'Date enrolled']
      ];

      $id = 0;
      $sql = mysqli_query($conn, "SELECT * FROM enrollment JOIN users ON enrollment.student_Id=users.user_Id JOIN teacher ON enrollment.teacher_Id=teacher.teacher_Id JOIN section ON enrollment.section_Id=section.sectionId WHERE section_Id='$sectionId' ORDER BY lastname");
      if (mysqli_num_rows($sql) > 0) {
        foreach ($sql as $row) {
          $id++;
          $studentName = $row['lastname']. ' ' .$row['suffix']. ', ' .$row['firstname']. ' ' .$row['middlename'];
          $teachersName = $row['t_firstname']. ' ' .$row['t_middlename']. ', ' .$row['t_middlename']. ' ' .$row['t_suffix'];
          $sectionEnrolled = $row['yearLevel'].' - '.$row['sectionName'];
          $student = array_merge($student, array(array($id, $row['enrollmentType'], $studentName, $sectionEnrolled, $teachersName, date("F d, Y", strtotime($row['date_enrolled'])))));
        }
      } else {
        $_SESSION['message'] = "No record found in the database.";
        $_SESSION['text'] = "Please try again.";
        $_SESSION['status'] = "error";
        header("Location: enrolled_students.php");
      }

      $xlsx = SimpleXLSXGen::fromArray($student);
      $xlsx->downloadAs('"'.$sectionEnrolled.'" records.xlsx'); // This will download the file to your local system

      // $xlsx->saveAs('student.xlsx'); // This will save the file to your server

      echo "<pre>";

      print_r($student);

      header('Location: enrolled_students.php');


}

?>
