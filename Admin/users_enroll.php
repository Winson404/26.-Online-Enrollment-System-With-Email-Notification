<title>Online Enrollment System | Student enrollment</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['user_Id'])) {
      $user_Id = $_GET['user_Id'];
      $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
      $row = mysqli_fetch_array($fetch);
      $yearLevel = $row['yearLevel'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Enroll student</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student enrollment</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          <div class="col-md-6">
            <form action="process_save.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="user_Id" value="<?php echo $user_Id; ?>">
              <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-12 mt-1 mb-2">
                          <a class="h5 text-primary"><b>Enrollment information</b></a>
                          <div class="dropdown-divider"></div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                              <span class="text-dark"><b>Full name</b></span>
                              <input type="text" class="form-control" value="<?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'] ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="col-12">
                          <div class="form-group">
                            <span class="text-dark"><b>Section</b></span>
                            <select class="form-control" name="section" required onchange="fetchTeacher(this.value)">
                              <option selected disabled value="">Select section</option>
                              <?php 
                                $fetch = mysqli_query($conn, "SELECT * FROM section WHERE yearLevel='$yearLevel'");
                                if(mysqli_num_rows($fetch) > 0) {
                                  while ($row = mysqli_fetch_array($fetch)) {
                              ?>
                                    <option value="<?php echo $row['sectionId']; ?>"><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></option>
                              <?php      
                                  }
                                } else {
                              ?>
                                  <option value="" selected>No section found according to student's year level.</option>
                              <?php
                                }
                              ?>
                              
                            </select>
                          </div>
                        </div>
                        
                        <div class="col-12">
                          <div class="form-group">
                            <label>Advisor</label>
                            <select class="form-control" name="teacher" required id="advisor">
                              <option selected disabled value="">Select section first</option>
                            </select>
                          </div>
                        </div>
                    </div>
                    <!-- END ROW -->
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <a href="users.php" class="btn bg-secondary"><i class="fa-solid fa-backward"></i> Back to list</a>
                    <button type="submit" class="btn bg-primary" name="enroll_student" id="create_admin"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- END CREATION -->

  </div>

<?php } else { include '404.php'; } ?>

<?php include 'footer.php';  ?>


<script>
    function fetchTeacher(section_Id){ 
    $('#advisor').html('');
    $.ajax({
    type:'post',
    url: 'ajaxdata.php',
    data : { section_Id : section_Id}, 
    success : function(data){
    $('#advisor').html(data);
    }
    })
    }
</script>