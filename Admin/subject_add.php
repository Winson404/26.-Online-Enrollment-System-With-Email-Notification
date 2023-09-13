<!-- CREATE NEW -->
<div class="modal fade" id="add_activity" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Create subject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_save.php" method="POST" enctype="multipart/form-data">
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
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="create_subject"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>




