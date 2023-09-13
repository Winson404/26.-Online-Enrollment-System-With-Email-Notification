<title>Online Enrollment System | Teacher's info</title>
<?php 
    include 'navbar.php';

    if(isset($_GET['teacher_Id'])) {
    $teacher_Id = $_GET['teacher_Id'];
    $fetch = mysqli_query($conn, "SELECT * FROM teacher JOIN section ON teacher.sectionAdvisory=section.sectionId WHERE teacher_Id='$teacher_Id'");
    $row = mysqli_fetch_array($fetch);
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h3>Teacher's info</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Teacher's info</li>
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
              <div class="card-body">
                  <div class="row p-2">
                    <div class="col-lg-12 mt-1 mb-2">
                      <a class="h5 text-primary"><b>Basic information</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-12">
                      <div class="row">
                        <div class="col-lg-12 col col-md-6 col-sm-6 col-12">
                          <div class="form-group">
                              <small class="text-muted"><b>Full name:</b></small>
                              <h6><?php echo ' '.$row['t_firstname'].' '.$row['t_middlename'].' '.$row['t_lastname'].' '.$row['t_suffix'].' '; ?></h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                              <small class="text-muted"><b>Date of Birth:</b></small>
                              <h6><?php echo date("F d, Y", strtotime($row['t_dob'])); ?></h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                              <small class="text-muted"><b>Age:</b></small>
                              <h6><?php echo $row['t_age']; ?></h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                              <small class="text-muted"><b>Sex:</b></small>
                              <h6><?php echo $row['t_gender']; ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-8 col col-md-8 col-sm-6 col-12">
                          <div class="form-group">
                              <small class="text-muted"><b>Place of Birth:</b></small>
                              <h6><?php echo $row['t_birthplace']; ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col col-md-4 col-sm-6 col-12">
                          <div class="form-group">
                              <small class="text-muted"><b>Civil Status:</b></small>
                              <h6><?php echo $row['t_civilstatus']; ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col col-md-4 col-sm-6 col-12">
                          <div class="form-group">
                              <small class="text-muted"><b>Profession/ Occupation:</b></small>
                              <h6><?php echo $row['t_occupation']; ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col col-md-4 col-sm-6 col-12">
                          <div class="form-group">
                              <small class="text-muted"><b>Religion:</b></small>
                              <h6><?php echo $row['t_religion']; ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col col-md-4 col-sm-6 col-12">
                          <div class="form-group">
                              <small class="text-muted"><b>Nationality:</b></small>
                              <h6><?php echo $row['t_nationality']; ?></h6>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 text-dark">
                      <div class=" d-flex justify-content-center bg-dark d-block m-auto" style="max-height: 120px; min-height: 120px; width: 120px; border: 3px solid darkgray;">
                        <img src="../images-users/<?php echo $row['t_image']; ?>" alt="" class="img-fluid d-block m-auto">
                      </div>
                      <p class="text-center text-sm text-muted">Teacher's photo</p>
                    </div>  
                  </div>


                  <div class="row p-2">
                    <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                      <a class="h5 text-primary"><b>Contact details</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                      <div class="col-lg-12 col-md-6 col-12">
                          <div class="row">
                            <div class="col-lg-6 col col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Email:</b></small>
                                  <h6><?php echo $row['t_email']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-6 col col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Contact number:</b></small>
                                  <h6><?php if($row['t_contact'] !== '') { echo '+63 '.$row['t_contact']; } ?></h6>
                                </div>
                            </div>                       
                          </div>
                      </div>                    
                  </div> 

                      
                  <div class="row p-2">
                    <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                      <a class="h5 text-primary"><b>Teacher's address</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                      <div class="col-lg-12 col-md-6 col-12">
                          <div class="row">
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>House No:</b></small>
                                  <h6><?php echo $row['t_house_no']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Street name:</b></small>
                                  <h6><?php echo $row['t_street_name']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Sitio/Purok:</b></small>
                                  <h6><?php echo $row['t_purok']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Zone:</b></small>
                                  <h6><?php echo $row['t_zone']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Barangay:</b></small>
                                  <h6><?php echo $row['t_barangay']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Municipality:</b></small>
                                  <h6><?php echo $row['t_municipality']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Province:</b></small>
                                  <h6><?php echo $row['t_province']; ?></h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col col-md-3 col-sm-6 col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Region:</b></small>
                                  <h6><?php echo $row['t_region']; ?></h6>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div> 


                  <div class="row p-2">
                    <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12">
                      <a class="h5 text-primary"><b>Advisory</b></a>
                      <div class="dropdown-divider"></div>
                    </div>
                      <div class="col-lg-12 col-md-6 col-12">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                  <small class="text-muted"><b>Advisory:</b></small>
                                  <h6><?php echo $row['yearLevel'].' - '.$row['sectionName']; ?></h6>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div> 

                  
                 
              </div>
              <div class="card-footer float-right">
                <a href="teacher.php" class="btn bg-secondary"><i class="fa-solid fa-circle-left"></i> Back to list</a>
                <a class="btn btn-info" href="teacher_mgmt.php?page=<?php echo $row['teacher_Id']; ?>"><i class="fas fa-pencil-alt"></i> Edit</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php } else { include '404.php'; } ?>
<?php include 'footer.php';  ?>

