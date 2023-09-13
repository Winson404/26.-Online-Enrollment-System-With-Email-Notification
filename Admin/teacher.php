<title>Online Enrollment System | Teacher records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Teacher records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Teacher records</li>
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
                <a href="teacher_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New teacher</a>

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">

                 <table id="example111" class="table table-bordered table-hover text-sm">
                  <thead>
                  <tr> 
                    <th>PHOTO</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>ADVISORY</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                  </thead>
                  <tbody id="users_data">
                      <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM teacher JOIN section ON teacher.sectionAdvisory=section.sectionId ORDER BY yearLevel ");
                        if(mysqli_num_rows($sql) > 0 ) {
                        while ($row = mysqli_fetch_array($sql)) {
                      ?>
                    <tr>
                        <td>
                            <a data-toggle="modal" data-target="#viewphoto<?php echo $row['teacher_Id']; ?>">
                              <img src="../images-users/<?php echo $row['t_image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                            </a href="">
                        </td>
                        <td><?php echo ' '.$row['t_firstname'].' '.$row['t_middlename'].' '.$row['t_lastname'].' '.$row['t_suffix'].' '; ?></td>
                        <td><?php echo $row['t_gender']; ?></td>
                        <td><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></td>
                        <td class="text-primary"><?php echo date("F d, Y", strtotime($row['t_date_registered'])); ?></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="teacher_view.php?teacher_Id=<?php echo $row['teacher_Id']; ?>"><i class="fas fa-folder"></i> View</a>
                          <a class="btn btn-info btn-sm" href="teacher_mgmt.php?page=<?php echo $row['teacher_Id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
                          <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['teacher_Id']; ?>"><i class="fas fa-trash"></i> Delete</button>
                        </td> 
                    </tr>

                    <?php include 'teacher_delete.php'; } } else { ?>
                      <tr>
                        <td colspan="100%" class="text-center">No record found</td>
                      </tr>
                    <?php }?>

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

