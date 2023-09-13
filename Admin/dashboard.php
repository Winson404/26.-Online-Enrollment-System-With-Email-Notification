<title>Online Enrollment System | Dashboard</title>
<?php include 'navbar.php'; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row d-flex justify-content-center">

         
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <?php
                  $users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type='User' AND user_status=0");
                  $row_users = mysqli_num_rows($users);
                ?>
                <h3><?php echo $row_users; ?></h3>

                <p>Pending students</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-group"></i>
              </div>
              <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <?php
                  $enrolled = mysqli_query($conn, "SELECT user_Id from users WHERE user_type='User' AND user_status=1");
                  $row_enrolled = mysqli_num_rows($enrolled);
                ?>
                <h3><?php echo $row_enrolled; ?></h3>

                <p>Enrolled students</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-group"></i>
              </div>
              <a href="enrolled_students.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  $teacher = mysqli_query($conn, "SELECT teacher_Id from teacher");
                  $row_teacher = mysqli_num_rows($teacher);
                ?>
                <h3><?php echo $row_teacher; ?></h3>

                <p>Teachers</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-chalkboard-user"></i>
              </div>
              <a href="teacher.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                  $section = mysqli_query($conn, "SELECT sectionId from section");
                  $row_section = mysqli_num_rows($section);
                ?>
                <h3><?php echo $row_section; ?></h3>

                <p>Section</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-puzzle-piece"></i>
              </div>
              <a href="section.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                  $users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type !='User'");
                  $row_users = mysqli_num_rows($users);
                ?>
                <h3><?php echo $row_users; ?></h3>

                <p>Administrators</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-secret"></i>
              </div>
              <a href="admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include 'footer.php'; ?>
