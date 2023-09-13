<title>Online Enrollment System | Enrolled student records</title>
<?php include 'navbar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Enrolled student records</h3>
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
                <div class="card-tools mr-1 mt-3">
                  <button type="button" class="btn btn-tool mb-1" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-3">
                
                    <?php 
                      if(isset($_POST['filter'])) {
                        $sectionId = $_POST['sectionId'];
                        $fetch = mysqli_query($conn, "SELECT * FROM enrollment JOIN users ON enrollment.student_Id=users.user_Id JOIN teacher ON enrollment.teacher_Id=teacher.teacher_Id JOIN section ON enrollment.section_Id=section.sectionId WHERE section_Id='$sectionId'");
                        if(mysqli_num_rows($fetch) > 0) {
                    ?>
                        <form method="POST">
                         <div class="row d-flex mb-2">
                           <div class="col-lg-3 col-md-3 col-sm-4 col-12 mt-1">
                                <div class="input-group">
                                  <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fa-solid fa-filter"></i>
                                  </div>
                                </div>
                                <select class="form-control form-control-sm small" name="sectionId" required>
                                  <option selected value="">Sort by section</option>
                                  <?php 
                                    $sec = mysqli_query($conn, "SELECT * FROM section ORDER BY sectionName");
                                    while($row = mysqli_fetch_array($sec)) { 
                                  ?>
                                  <option value="<?php echo $row['sectionId']; ?>"><?php echo $row['yearLevel'].' - '.$row['sectionName']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                           </div>
                            <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                               <button type="submit" name="filter" class="btn btn-dark btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                               <button type="button" class="m-1 btn btn-primary btn-sm" onclick=location=URL><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                             </div>
                             <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                               <a href="export.php?enrolled=<?php echo $sectionId; ?>" class="btn btn-sm bg-success float-right mr-2"><i class="fa-solid fa-file-excel"></i> Export </a>
                             </div>
                         </div>
                        </form>
                         <table id="example111" class="table table-bordered table-hover text-sm">
                          <thead>
                          <tr> 
                            <th>PHOTO</th>
                            <th>STUDENT NAME</th>
                            <th>SECTION ENROLLED</th>
                            <th>ADVISER</th>
                            <th>DATE ENROLLED</th>
                          </tr>
                          </thead>
                          <tbody id="users_data">
                              <?php while ($row = mysqli_fetch_array($fetch)) { ?>
                            <tr>
                                <td>
                                    <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                                      <img src="../images-users/<?php if($row['image'] == '') { echo 'user.png'; } else { echo $row['image']; } ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                                    </a href="">
                                </td>
                                <td><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></td>
                                <td><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></td>
                                <td><?php echo $row['t_firstname'].' '.$row['t_middlename'].' '.$row['t_lastname'].' '.$row['t_suffix']; ?></td>
                                <td><?php echo date("F d, Y", strtotime($row['date_enrolled'])); ?></span></td>
                            </tr>
                            <?php include 'users_delete.php'; } ?>
                          </tbody>
                        </table>

                    <?php } else { ?>
                         <form method="POST">
                           <div class="row d-flex mb-2">
                             <div class="col-lg-3 col-md-3 col-sm-4 col-12 mt-1">
                                  <div class="input-group">
                                    <div class="input-group-append">
                                    <div class="input-group-text">
                                      <i class="fa-solid fa-filter"></i>
                                    </div>
                                  </div>
                                  <select class="form-control form-control-sm small" name="sectionId" required>
                                    <option selected value="">Sort by section</option>
                                    <?php 
                                      $sec = mysqli_query($conn, "SELECT * FROM section ORDER BY sectionName");
                                      while($row = mysqli_fetch_array($sec)) { 
                                    ?>
                                    <option value="<?php echo $row['sectionId']; ?>"><?php echo $row['yearLevel'].' - '.$row['sectionName']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                             </div>
                              <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                                 <button type="submit" name="filter" class="btn btn-dark btn-sm"><i class="fa-solid fa-filter"></i> Filter</button>
                                 <button type="button" name="filter" class="m-1 btn btn-primary btn-sm" onclick=location=URL><i class="fa-solid fa-arrows-rotate"></i> Refresh</button>
                               </div>                          
                           </div>
                          </form>
                           <table id="example111" class="table table-bordered table-hover text-sm">
                              <thead>
                              <tr> 
                                <th>PHOTO</th>
                                <th>STUDENT NAME</th>
                                <th>SECTION ENROLLED</th>
                                <th>ADVISER</th>
                                <th>DATE ENROLLED</th>
                              </tr>
                              </thead>
                              <tbody id="users_data">
                                <tr>
                                  <td colspan="100%" class="text-center">No record found</td>
                                </tr>
                              </tbody>
                            </table>

                    <?php } } else { ?>

                        <form method="POST">
                         <div class="row d-flex mb-2">
                           <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                                <div class="input-group">
                                  <div class="input-group-append">
                                  <div class="input-group-text">
                                    <i class="fa-solid fa-filter"></i>
                                  </div>
                                </div>
                                <select class="form-control form-control-sm small" name="sectionId" required>
                                  <option selected value="">Sort by section</option>
                                  <?php 
                                    $sec = mysqli_query($conn, "SELECT * FROM section ORDER BY sectionName");
                                    while($row = mysqli_fetch_array($sec)) { 
                                  ?>
                                  <option value="<?php echo $row['sectionId']; ?>"><?php echo $row['yearLevel'].' - '.$row['sectionName']; ?></option>
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
                            <th>STUDENT NAME</th>
                            <th>SECTION ENROLLED</th>
                            <th>ADVISER</th>
                            <th>DATE ENROLLED</th>
                          </tr>
                          </thead>
                          <tbody id="users_data">
                              <?php 
                                $sql = mysqli_query($conn, "SELECT * FROM enrollment JOIN users ON enrollment.student_Id=users.user_Id JOIN teacher ON enrollment.teacher_Id=teacher.teacher_Id JOIN section ON enrollment.section_Id=section.sectionId ORDER BY firstname");
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
                                <td><?php echo $row['yearLevel'].'-'.$row['sectionName']; ?></td>
                                <td><?php echo $row['t_firstname'].' '.$row['t_middlename'].' '.$row['t_lastname'].' '.$row['t_suffix']; ?></td>
                                <td><?php echo date("F d, Y", strtotime($row['date_enrolled'])); ?></span></td>
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
