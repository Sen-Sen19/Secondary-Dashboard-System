<?php include 'plugins/navbar.php'; ?>
<?php include 'plugins/sidebar/me_bar.php'; ?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="nav-icon fas fa-user"></i> ADMIN
                            </h3>



                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="row mb-2">
                            </div>

                            <div class="row mt-1 align-items-center">
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-success custom-btn" id="openModalBtn" data-toggle="modal"
                                        data-target="#addRecordModal" style="height: 35px; width: 100%;">
                                        <i class="fas fa-plus mr-2"></i>Add Account
                                    </button>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <button class="btn btn-danger custom-btn" id="deleteBtn"
                                        style="height: 35px; width: 100%;">
                                        <i class="fas fa-trash mr-2"></i>Delete
                                    </button>
                                </div>

                            </div>
                        </div>





                        <div id="accounts_table_res" class="table-responsive"
                            style="height: 45vh; overflow: auto; display: inline-block; margin-top: 20px; border-top: 1px solid gray;">
                            <table id="account" class="table table-sm table-head-fixed text-nowrap table-hover">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>User Name</th>
                                        <th>Section</th>
                                        <th>Password</th>
                                        <th>Type</th>
                                        <th>Shift</th>
                                        <th>Select</th>

                                    </tr>
                                </thead>

                                <tbody id="admin_body" style="text-align: center; padding:10px;">

                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="d-flex justify-content-sm-center">
                            <button type="button" class="btn bg-gray-dark" id="btnLoadMore">Load more</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="editRecordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-color: #007bff;">
      <div class="modal-header" style="background-color: rgb(47, 137, 255);">
        <h5 class="modal-title" id="editRecordModalLabel" style="color:white;"><i class="fas fa-user-edit mr-2"></i>EDIT RECORD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="editForm">
        <div class="modal-body">
          <div class="row">
            <!-- Username -->
            <div class="col-md-6 form-group">
              <label for="editUsername">Username</label>
              <input type="text" class="form-control" id="editUsername" name="username" required readonly>
            </div>

            <!-- Password -->
            <div class="col-md-6 form-group">
              <label for="editPassword">Password</label>
         <input type="text" class="form-control" id="editPassword" name="newPassword" ">

            </div>
          </div>

          <div class="row">
            <!-- Type -->
            <div class="col-md-4 form-group">
              <label for="editType">Type</label>
              <select class="form-control" id="editType" name="type" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>

            <!-- Section -->
            <div class="col-md-4 form-group">
              <label for="editSection">Section</label>
              <select class="form-control" id="editSection" name="section" required>
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

            
            <!-- Password -->
            <div class="col-md-4 form-group">
              <label for="editShift">Shift</label>
             <select class="form-control" id="editShift" name="section" required>
                <option value="" disabled selected>Choose...</option>
                <option value="A">A</option>
                <option value="B">B</option>
            
   
              </select>
            </div>
          </div>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;" onclick="saveChanges()">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>








<script>
function saveChanges() {
    const username = document.getElementById('editUsername').value;
    const newPassword = document.getElementById('editPassword').value;
    const section = document.getElementById('editSection').value;
    const type = document.getElementById('editType').value;
    const shift = document.getElementById('editShift').value;

    const formData = new URLSearchParams();
    formData.append('username', username);
    formData.append('newPassword', newPassword);
    formData.append('section', section);
    formData.append('type', type);
    formData.append('shift', shift);

    fetch('../../process/admin_update_account.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData.toString()
    })
    .then(response => response.text())
    .then(response => {
        if (response.startsWith('Error')) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Account updated successfully!',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                document.getElementById('editRecordModal').classList.remove('show'); // Optional manual hide
                location.reload();
            });
        }
    })
    .catch(error => {
        console.error('Error updating account:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'You do not have permission or something went wrong.'
        });
    });
}

</script>

<?php include 'plugins/me_footer.php'; ?>
<?php include 'plugins/js/me_script.php'; ?>

</body>

</html>