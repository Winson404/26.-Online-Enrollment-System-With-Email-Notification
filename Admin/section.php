<title>Online Enrollment System | Setion records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Setion records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Setion records</li>
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
                <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#add_activity"><i class="fa-sharp fa-solid fa-square-plus"></i> New section</button>
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
                          <select class="form-control form-control-sm small" id="yearLevel" onchange="myFunctionCategory()">
                            <option selected value="">Sort by year level</option>
                            <?php 
                              $fetch = mysqli_query($conn, "SELECT DISTINCT yearLevel FROM section ORDER BY yearLevel");
                              while($row = mysqli_fetch_array($fetch)) { 
                            ?>
                            <option value="<?php echo $row['yearLevel']; ?>"><?php echo $row['yearLevel']; ?></option>
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
                    <th width="15%">SECTION NAME</th>
                    <th width="65%">YEAR LEVEL</th>
                    <th width="20%">ACTIONS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM section ORDER BY sectionName");
                      if(mysqli_num_rows($sql) > 0 ) {
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['sectionName']; ?></td>
                        <td class="bg-grey text-muted text-justify"><?php echo $row['yearLevel']; ?></td>
                        <td class="bg-grey text-muted">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['sectionId']; ?>"><i class="fas fa-pencil-alt"></i> Edit</button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sectionId']; ?>"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <?php include 'section_update_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No section found</td>
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

<?php include 'section_add.php'; include 'footer.php';  ?>

<script>
  function myFunctionCategory(cat_Id){ 

      var x = document.getElementById("yearLevel").value;
      
      $.ajax({
      type:'post',
      url: 'ajaxdata.php',
      data : 'displaySection=' + x, 
      success : function(data){
      $('#users_data').html(data);
      }
      })
    }
</script>

