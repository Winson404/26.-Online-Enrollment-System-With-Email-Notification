	<?php
	include '../config.php';

	// GET SUBJECTS AUTOMATICALLY ACCORDING TO GRADE LEVEL AFTER BEING SELECTED IN assigning_update_delete.php file
	if (isset($_POST['yearLevel'])) {
		$yearLevel = $_POST['yearLevel'];
		$fetch = mysqli_query($conn, "SELECT * FROM section WHERE yearLevel='$yearLevel'");
		if(mysqli_num_rows($fetch) > 0) {
			echo '<option selected disabled value="">Select section</option>';	
			while($row = mysqli_fetch_array($fetch)) {
				echo '<option value="'.$row['sectionId'].'">  '.$row['yearLevel'].' - '.$row['sectionName'].' </option>';
			}
		} else {
			echo '<option selected disabled>No section found</option>';	
		 }
		
	}

 


	// DISPLAY SUBJECT BY SECTION - SUBJECT.PHP
	if(isset($_POST['request'])) {
		$sectionName = $_POST['request'];
		$subject = mysqli_query($conn, "SELECT * FROM subject JOIN section ON subject.sectionId=section.sectionId WHERE sectionName='$sectionName' ");
		if(mysqli_num_rows($subject) > 0) {
?>
        <?php while ($row = mysqli_fetch_array($subject)) { ?>
	  <tr>
        <td class="bg-grey text-muted text-justify"><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></td>
        <td class="bg-grey text-muted text-justify"><?php echo $row['subjectName']; ?></td>
        <td class="bg-grey text-muted text-justify"><?php echo $row['subjectTime']; ?></td>
        <td class="bg-grey text-muted">
          <a class="btn btn-info btn-sm" href="subject_mgmt.php?page=<?php echo $row['subjectId']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['subjectId']; ?>"><i class="fas fa-trash"></i> Delete</button>
        </td>
      </tr>

<?php } } else { ?>	
	<tr>
		<td colspan="100%" class="text-center">No record found</td>
    <tr/>
    
<?php } } 



	
		// GET TEACHERS AUTOMATICALLY WHEN SECTION IS BEING SELECTED - USERS_ENROLL.PHP
	if (isset($_POST['section_Id'])) {
		$section_Id = $_POST['section_Id'];
		$fetch = mysqli_query($conn, "SELECT * FROM teacher JOIN section ON teacher.sectionAdvisory=section.sectionId WHERE teacher.sectionAdvisory='$section_Id'");
		if(mysqli_num_rows($fetch) > 0) {
			while($row = mysqli_fetch_array($fetch)) {
				echo '<option value="'.$row['teacher_Id'].'">  '.$row['t_firstname'].' '.$row['t_middlename'].' '.$row['t_lastname'].' '.$row['t_suffix'].' </option>';
			}
		} else {
			echo '<option selected disabled value="">No assigned teacher in this selected section</option>';	
		}
		
	}









	// DISPLAY SECTION BY GRADE LEVEL - SECTION.PHP
	if(isset($_POST['displaySection'])) {
		$yearLevel = $_POST['displaySection'];
		$subject = mysqli_query($conn, "SELECT * FROM section WHERE yearLevel='$yearLevel' ");
		if(mysqli_num_rows($subject) > 0) {
?>
        <?php while ($row = mysqli_fetch_array($subject)) { ?>
	    <tr>
		    <td class="bg-grey text-muted text-justify"><?php echo $row['sectionName']; ?></td>
		    <td class="bg-grey text-muted text-justify"><?php echo $row['yearLevel']; ?></td>
		    <td class="bg-grey text-muted">
		      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['sectionId']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
		      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sectionId']; ?>"><i class="fas fa-trash"></i> Delete</button>
		    </td>
		</tr>

<?php } } else { ?>	
	<tr>
		<td colspan="100%" class="text-center">No record found</td>
    <tr/>
    
<?php } } 



?>