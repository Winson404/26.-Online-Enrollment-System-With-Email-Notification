<title>Online Enrollment System | Subject info</title>
<?php 
    include 'navbar.php'; 
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">



  <?php if($page === 'create') { ?>

    <!-- CREATION -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>New Subject</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Subject info</li>
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
              <div class="card">
                <div class="card-body">
                    <div class="form-group">
                      <span class="text-dark"><b>Year level</b></span>
                      <select class="form-control" id="yearLevel" onchange="myFunction(this.value)">
                        <option selected disabled value="">Select level</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <form method="POST">
                        <span><b>Section:</b></span>
                        <select class="form-control" id="section" style="width: 100%;" name="section" required>
                            <option selected disabled value="">Select year level first</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <span class="text-dark"><b>Subject name</b></span>
                      <input type="text" class="form-control" name="subject" required>
                    </div>
                    <div class="form-group">
                      <span class="text-dark"><b>Subject time</b></span>
                      <input type="time" class="form-control" name="subjectTime" required>
                    </div>
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <a href="subject.php" class="btn bg-secondary"><i class="fa-solid fa-backward"></i> Back to list</a>
                    <button type="submit" class="btn bg-primary" name="create_subject"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- END CREATION -->




<?php } else { 
  $subjectId = $page;
  $fetch = mysqli_query($conn, "SELECT * FROM subject JOIN section ON subject.sectionId=section.sectionId WHERE subject.subjectId='$subjectId'");
  $row = mysqli_fetch_array($fetch);
?>

    
    <!-- UPDATE -->
   <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Update Subject</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Subject info</li>
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
            <form action="process_update.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" name="subjectId" required value="<?php echo $row['subjectId']; ?>">
              <div class="card">
                <div class="card-body">
                    <div class="form-group">
                      <span class="text-dark"><b>Year level</b></span>
                      <select class="form-control" id="yearLevel" onchange="myFunction(this.value)">
                        <option selected disabled value="">Select level</option>
                        <option value="Grade 7" <?php if($row['yearLevel'] == 'Grade 7') { echo 'selected'; } ?>>Grade 7</option>
                        <option value="Grade 8" <?php if($row['yearLevel'] == 'Grade 8') { echo 'selected'; } ?>>Grade 8</option>
                        <option value="Grade 9" <?php if($row['yearLevel'] == 'Grade 9') { echo 'selected'; } ?>>Grade 9</option>
                        <option value="Grade 10" <?php if($row['yearLevel'] == 'Grade 10') { echo 'selected'; } ?>>Grade 10</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <form method="POST">
                        <span><b>Section:</b></span>
                        <select class="form-control" id="section" style="width: 100%;" name="section" required>
                            <option value="<?php echo $row['sectionId']; ?>"><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                      <span class="text-dark"><b>Subject name</b></span>
                      <input type="text" class="form-control" name="subject" required value="<?php echo $row['subjectName']; ?>">
                    </div>
                    <div class="form-group">
                      <span class="text-dark"><b>Subject time</b></span>
                      <input type="time" class="form-control" name="subjectTime" required value="<?php echo $row['subjectTime']; ?>">
                    </div>
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <a href="subject.php" class="btn bg-secondary"><i class="fa-solid fa-backward"></i> Back to list</a>
                    <button type="submit" class="btn bg-primary" name="update_subject"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- END UPDATE -->



<?php } ?>







  </div>

<?php } else { include '404.php'; } ?>

<?php include 'footer.php';  ?>

<script>
  function myFunction(yearLevel){ 

      var x = document.getElementById("yearLevel").value;

      $('#section').html('');
      $.ajax({
      type:'post',
      url: 'ajaxdata.php',
      data : { yearLevel : yearLevel}, 
      success : function(data){
      $('#section').html(data);
      }
      })
    }
</script>