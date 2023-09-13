<title>Online Enrollment System | Subject records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Subject records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Subject records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <!-- <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New subject</button> -->
                <a href="subject_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New subject</a>
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                  <div class="row d-flex mb-3">
                     <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                          <div class="input-group">
                            <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="fa-solid fa-filter"></i>
                            </div>
                          </div>
                          <select class="form-control form-control-sm small" id="section" onchange="myFunctionCategory()">
                            <option selected value="">Sort by section</option>
                            <?php 
                              $fetch = mysqli_query($conn, "SELECT * FROM section GROUP BY sectionName ORDER BY sectionName");
                              while($row = mysqli_fetch_array($fetch)) { 
                            ?>
                            <option value="<?php echo $row['sectionName']; ?>"><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <button type="button" class="m-1 btn btn-primary btn-sm" onclick=location=URL><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                     </div>
                   </div>
                  <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr class="bg-light">
                    <th>SECTION NAME</th>
                    <th>SUBJECT NAME</th>
                    <th>SUBJECT TIME</th>
                    <th>ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM subject JOIN section ON subject.sectionId=section.sectionId ORDER BY subjectName");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['subjectName']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['subjectTime']; ?></td>
                        <td class="bg-grey text-muted">
                          <a class="btn btn-info btn-sm" href="subject_mgmt.php?page=<?php echo $row['subjectId']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['subjectId']; ?>"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <?php include 'subject_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No subject found</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php include 'footer.php';  ?>
<!-- <script>
  window.addEventListener("load", window.print());
</script> -->

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



    function myFunctionCategory(cat_Id){ 

      var x = document.getElementById("section").value;
      
      $.ajax({
      type:'post',
      url: 'ajaxdata.php',
      data : 'request=' + x, 
      success : function(data){
      $('#users_data').html(data);
      }
      })
    }
</script>