<title>Online Enrollment System | Enrollment information</title>
<?php 
    include 'navbar.php'; 
    // FETCH SUBJECT UNDER ENROLLED SECTION OF THE STUDENT
    $sql = mysqli_query($conn, "SELECT * FROM enrollment JOIN users ON enrollment.student_Id=users.user_Id JOIN section ON enrollment.section_Id=section.sectionId JOIN subject ON section.sectionId=subject.sectionId WHERE enrollment.student_Id='$id' ");

    // GET TEACHERS NAME FROM THE ENROLLED SECTION OF THE STUDENT
    $sql2 = mysqli_query($conn, "SELECT * FROM enrollment JOIN users ON enrollment.student_Id=users.user_Id JOIN section ON enrollment.section_Id=section.sectionId JOIN teacher ON enrollment.teacher_Id=teacher.teacher_Id WHERE enrollment.student_Id='$id' ");
    $teachersName = mysqli_fetch_array($sql2);
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Enrollment information</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Enrollment information</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-11">
            <div class="card card-secondary">
              <div class="card-header">
                <h5>Enrollment details</h5>
              </div>
              <div class="offset-11 mt-1">
                <?php if($row['user_status'] == 1): ?>
                  <button class="btn btn-secondary" id="printButton"><i class="fa-solid fa-print"></i> Print</button>
                <?php endif; ?>
              </div>
               <div class="container"id="printElement">
                      <p class="text-sm ml-3">Date enrolled: <?php echo date("F d, Y", strtotime($teachersName['date_enrolled'])); ?></p>
                      <div class="row d-flex justify-content-center">

                      <div class="wrapper row p-3">
                         <div class="col-12 invoice-col">
                          <img src="../images-users/<?php echo $row['image']; ?>" alt="" class=" m-2 border" width="100" height="100">
                        </div>
                        <div class="col-sm-12 col-12 p-3" style="line-height: 10px;">
                          <p>
                            Name:&nbsp;&nbsp;<?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?>
                          </p>
                          <p>
                            Age:&nbsp;&nbsp;<?php echo $row['age']; ?>
                          </p>
                          <p>
                            Permanent Address:&nbsp;&nbsp;<?php echo ''.$row['house_no'].' '.$row['street_name'].' '.$row['purok'].' '.$row['zone'].' '.$row['barangay'].' '.$row['municipality'].' '.$row['province'].' '.$row['region'].''; ?>
                          </p>
                          <p>
                            Guardian name:&nbsp;&nbsp;<?php echo $row['guardianName']; ?>
                          </p>
                          <p>
                            Guardian contact:&nbsp;&nbsp;+63 <?php echo $row['guardianContact']; ?>
                          </p>
                      </div>

                          <?php if($row['user_status'] == 0): ?>
                              <div class="col-12 p-3">
                                <p>Section enrolled: N/A</p>
                                <hr>
                              </div>
                              <div class="col-lg-12 p-3">
                                <table class="table table-bordered table-striped " style="border: 1px solid lightgrey;">
                                  <h5>My subject lists:</h5>
                                  <thead>
                                  <tr>
                                    <th width="50%" style="border: 1px solid lightgrey;">SUBJECT NAME</th>
                                    <th width="30%" style="border: 1px solid lightgrey;">TIME</th>
                                  </tr>
                                  </thead>
                                  <tbody id="users_data">
                                    <tr>
                                      <td colspan="100%" class="text-center">Subjects will be automatically displayed when you are officially enrolled</td>
                                    </tr>
                                  </tbody>
                                </table> 
                              </div>  
                          <?php else: ?>
                              <div class="col-12 p-3">
                                <p>Section enrolled: <?php echo $teachersName['yearLevel'].'-'.$teachersName['sectionName']; ?></p>
                                <hr>
                              </div>
                              <div class="col-lg-12 p-3">
                                <table class="table table-bordered table-striped " style="border: 1px solid lightgrey;">
                                  <h5>My subject lists:</h5>
                                  <thead>
                                  <tr>
                                    <th width="50%" style="border: 1px solid lightgrey;">SUBJECT NAME</th>
                                    <th width="30%" style="border: 1px solid lightgrey;">TIME</th>
                                  </tr>
                                  </thead>
                                  <tbody id="users_data">
                                    <?php                        
                                        if(mysqli_num_rows($sql) > 0 ) {
                                        while ($row = mysqli_fetch_array($sql)) {
                                      ?>
                                    <tr>
                                        <td style="border: 1px solid lightgrey;"><?php echo $row['subjectName']; ?></td>
                                        <td style="border: 1px solid lightgrey;"><?php echo $row['subjectTime']; ?></td>
                                    </tr>

                                    <?php } } else { ?>
                                      <tr>
                                        <td colspan="100%" class="text-center">No record found</td>
                                      </tr>
                                    <?php }?>
                                  </tbody>
                                </table> 
                              </div>
                          <?php endif; ?>

                      </div>
                    </div>
            </div>

              
                   
  
         </div>
        </div>
      </div>
    </section>
</div>


 
<script src="print.js"></script>
<?php include 'footer.php'; ?>
 

