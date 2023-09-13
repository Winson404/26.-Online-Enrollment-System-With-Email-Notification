<!-- UPDATE -->
<div class="modal fade" id="update<?php echo $row['sectionId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Update section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_update.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" class="form-control" name="sectionId" required value="<?php echo $row['sectionId']; ?>">
          <div class="form-group">
            <span class="text-dark"><b>Section name</b></span>
            <input type="text" class="form-control" name="section" required value="<?php echo $row['sectionName']; ?>">
          </div>
          <div class="form-group">
            <span class="text-dark"><b>Year level</b></span>
            <select class="form-control" name="yearLevel" required>
              <option selected disabled value="">Select level</option>
              <option value="Grade 7" <?php if($row['yearLevel'] == 'Grade 7') { echo 'selected'; } ?>>Grade 7</option>
              <option value="Grade 8" <?php if($row['yearLevel'] == 'Grade 8') { echo 'selected'; } ?>>Grade 8</option>
              <option value="Grade 9" <?php if($row['yearLevel'] == 'Grade 9') { echo 'selected'; } ?>>Grade 9</option>
              <option value="Grade 10" <?php if($row['yearLevel'] == 'Grade 10') { echo 'selected'; } ?>>Grade 10</option>
            </select>
          </div>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-primary" name="update_section"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['sectionId']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-puzzle-piece"></i> Delete section</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['sectionId']; ?>" name="sectionId">
          <h6 class="text-center">Delete section record?</h6>
      </div>
      <div class="modal-footer alert-light">
        <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
        <button type="submit" class="btn bg-danger" name="delete_section"><i class="fas fa-trash"></i> Delete</button>
      </div>
        </form>
    </div>
  </div>

