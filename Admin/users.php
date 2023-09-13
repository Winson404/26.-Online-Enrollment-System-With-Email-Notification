<title>Online Enrollment System | Pending student records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Pending student records</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Student records</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                
               <a href="users_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> New student</a>

                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                
                <?php 
                  if(isset($_POST['filter'])) {
                    $yearLevel = mysqli_real_escape_string($conn, $_POST['yearLevel']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND user_status=0 AND yearLevel='$yearLevel' ORDER BY firstname");
                ?>

                    <form method="POST">
                       <div class="row d-flex mb-2">
                         <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                              <div class="input-group">
                                <div class="input-group-append">
                                <div class="input-group-text">
                                  <i class="fa-solid fa-filter"></i>
                                </div>
                              </div>
                              <select class="form-control form-control-sm small" name="yearLevel" required>
                                <option selected value="">Sort by year level</option>
                                <?php 
                                  $fetch = mysqli_query($conn, "SELECT DISTINCT yearLevel FROM users WHERE user_type='User' ORDER BY firstname");
                                  while($row = mysqli_fetch_array($fetch)) { 
                                ?>
                                <option value="<?php echo $row['yearLevel']; ?>"><?php echo $row['yearLevel']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                            <button type="submit" name="filter" class="btn btn-dark btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                            <button type="button" class="m-1 btn btn-primary btn-sm" onclick=location=URL><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                          </div>
                         <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                           <a href="export.php?yearLevel=<?php echo $yearLevel; ?>" class="btn btn-sm bg-success float-right"><i class="fa-solid fa-file-excel"></i> Export</a>
                         </div>
                       </div>
                      </form>
                       <table id="example111" class="table table-bordered table-hover text-sm">
                        <thead>
                        <tr> 
                          <th>PHOTO</th>
                          <th>NAME</th>
                          <th>YR. LEVEL</th>
                          <th>GENDER</th>
                          <th>EMAIL/CONTACT NO</th>
                          <th>TOOLS</th>
                        </tr>
                        </thead>
                        <tbody id="users_data">
                            <?php 
                              if(mysqli_num_rows($sql) > 0 ) {
                              while ($row = mysqli_fetch_array($sql)) {

                            ?>
                          <tr>
                              <td>
                                  <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                    <img src="../images-users/<?php if($row['image'] == '') { echo 'user.png'; } else { echo $row['image']; } ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                                  </a href="">
                              </td>
                              <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                              <td><?php echo $row['yearLevel']; ?></td>
                              <td><?php echo $row['gender']; ?></td>
                              <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                              <td>
                                <a class="btn btn-primary btn-sm" href="users_view.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fas fa-folder"></i></a>
                                <a class="btn btn-info btn-sm" href="users_mgmt.php?page=<?php echo $row['user_Id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['user_Id']; ?>"><i class="fas fa-trash"></i></button>
                                <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#password<?php// echo $row['user_Id']; ?>"><i class="fa-solid fa-lock"></i></button> -->
                                <a class="btn btn-info btn-sm" href="users_mgmt.php?page=<?php echo $row['user_Id']; ?>"><i class="fas fa-pencil-alt"></i> Enroll student</a>
                              </td> 
                          </tr>

                          <?php include 'users_delete.php'; } } else { ?>
                            <tr>
                              <td colspan="100%" class="text-center">No record found</td>
                            </tr>
                          <?php }?>

                        </tbody>
                      </table>

                <?php } else { ?>

                    <form method="POST">
                       <div class="row d-flex mb-2">
                         <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                              <div class="input-group">
                                <div class="input-group-append">
                                <div class="input-group-text">
                                  <i class="fa-solid fa-filter"></i>
                                </div>
                              </div>
                              <select class="form-control form-control-sm small" name="yearLevel" required>
                                <option selected value="">Sort by year level</option>
                                <?php 
                                  $fetch = mysqli_query($conn, "SELECT DISTINCT yearLevel FROM users WHERE user_type='User' ORDER BY firstname");
                                  while($row = mysqli_fetch_array($fetch)) { 
                                ?>
                                <option value="<?php echo $row['yearLevel']; ?>"><?php echo $row['yearLevel']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                         </div>
                         <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                            <button type="submit" name="filter" class="btn btn-dark btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                          </div>
                       </div>
                      </form>
                       <table id="example111" class="table table-bordered table-hover text-sm">
                        <thead>
                        <tr> 
                          <th>PHOTO</th>
                          <th>NAME</th>
                          <th>YR. LEVEL</th>
                          <th>GENDER</th>
                          <th>EMAIL/CONTACT NO</th>
                          <th>TOOLS</th>
                        </tr>
                        </thead>
                        <tbody id="users_data">
                            <?php 
                              $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'User' AND user_status=0 ORDER BY firstname");
                              if(mysqli_num_rows($sql) > 0 ) {
                              while ($row = mysqli_fetch_array($sql)) {

                            ?>
                          <tr>
                              <td>
                                  <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                    <img src="../images-users/<?php if($row['image'] == '') { echo 'user.png'; } else { echo $row['image']; } ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                                  </a href="">
                              </td>
                              <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                              <td><?php echo $row['yearLevel']; ?></td>
                              <td><?php echo $row['gender']; ?></td>
                              <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                              <td>
                                <a class="btn btn-primary btn-sm" href="users_view.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fas fa-folder"></i></a>
                                <a class="btn btn-info btn-sm" href="users_mgmt.php?page=<?php echo $row['user_Id']; ?>"><i class="fas fa-pencil-alt"></i></a>
                                <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['user_Id']; ?>"><i class="fas fa-trash"></i></button>
                                <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#password<?php //echo $row['user_Id']; ?>"><i class="fa-solid fa-lock"></i></button> -->
                                 <a class="btn btn-success btn-sm" href="users_enroll.php?user_Id=<?php echo $row['user_Id']; ?>"><i class="fa-solid fa-circle-check"></i></a>
                              </td> 
                          </tr>

                          <?php include 'users_delete.php'; } } else { ?>
                            <tr>
                              <td colspan="100%" class="text-center">No record found</td>
                            </tr>
                          <?php }?>

                        </tbody>
                      </table>

                <?php } ?>

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