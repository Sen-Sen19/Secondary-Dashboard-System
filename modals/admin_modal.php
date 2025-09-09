<style>
  .is-invalid {
    border-color: #dc3545;
  }

  /* Custom width for the modal to match the edit modal width */
  .modal-dialog {
    max-width: 600px; /* Adjust width to your preference */
  }
</style>

<div class="modal fade" id="addRecordModal" tabindex="-1" role="dialog" aria-labelledby="addRecordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"> <!-- Removed modal-xl and set custom width -->
    <div class="modal-content" style="border-color: #007bff;">
      <div class="modal-header" style="background-color:#007bff">
        <h5 id="addRecordModalLabel" style="color:white"><i class="fas fa-user-plus mr-2"></i>ADD RECORD</h5>
        <button type="button" class="close" data-dismiss="modal" style="color:white" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="myForm">
        <div class="modal-body">
          <div class="row">
            <!-- Username -->
            <div class="col-md-6 form-group">
              <label for="username">Username</label>
              <input type="text" id="username" name="username" class="form-control" autocomplete="off">
            </div>
            <!-- Password -->
            <div class="col-md-6 form-group">
              <label for="password">Password</label>
              <input type="text" id="password" name="password" class="form-control" autocomplete="off">
            </div>
          </div>

          <div class="row">
            <!-- Type -->
           <div class="col-md-4 form-group">
    <label for="type">Type</label>
    <select id="type" class="form-control" name="type">
         <option value="" disabled selected>Choose...</option>
      <option value="admin">Admin</option>
      <option value="me">ME</option>
      <option value="user">User</option>
    </select>
  </div>

  <!-- Section -->
  <div class="col-md-4 form-group">
    <label for="section">Section</label>
    <select class="form-control" id="section" name="section" required>
      <option value="" disabled selected>Choose...</option>
      <option value="Section 1">Section 1</option>
      <option value="Section 2">Section 2</option>
      <option value="Section 3">Section 3</option>
      <option value="Section 3.1">Section 3.1</option>
      <option value="Section 4">Section 4</option>
      <option value="Section 5">Section 5</option>
      <option value="Section 6">Section 6</option>
      <option value="Section 7">Section 7</option>
      <option value="Section 8">Section 8</option>
    </select>
  </div>

  <!-- Shift -->
  <div class="col-md-4 form-group">
    <label for="shift">Shift</label>
    <select class="form-control" id="shift" name="shift" required>
      <option value="" disabled selected>Select Shift</option>
      <option value="A">A</option>
      <option value="B">B</option>

    </select>
  </div>

          <div id="notice" style="display: none;"></div>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger">Clear</button>
          <button type="button" id="saveButton" class="btn btn-success"
            style="width: 150px; background-color: #20c997; border-color: #20c997; color: white;"
            onclick="saveData()">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
