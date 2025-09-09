

<?php




if (isset($_SESSION['username'])) {
    $loggedInUser = $_SESSION['username'];
    echo '<script>';
    echo 'document.addEventListener("DOMContentLoaded", function() {';


    echo '});';
    echo '</script>';
}
?>



<style>
.larger-checkbox {
    width: 20px; /* Adjust width as needed */
    height: 20px; /* Adjust height as needed */
}
</style>



<script>

// --------------------------------modal open------------------------
document.getElementById("openModalBtn").addEventListener("click", function() {
     
    });







// -------------------------Clear Button----------------------------------
document.addEventListener("DOMContentLoaded", function() {
    const clearButton = document.querySelector("#addRecordModal .btn-danger");

    clearButton.addEventListener("click", function() {
        const inputs = document.querySelectorAll("#addRecordModal input");
        const selects = document.querySelectorAll("#addRecordModal select");
        const textareas = document.querySelectorAll("#addRecordModal textarea");
        const excludedIds = ['inspected_by', 'inspection_date'];

        inputs.forEach(input => {
            if (!excludedIds.includes(input.id) && input.type !== 'button' && input.type !== 'submit') {
                input.value = '';
            }
        });

        selects.forEach(select => {
            if (!excludedIds.includes(select.id)) {
                select.selectedIndex = 0;
            }
        });

        textareas.forEach(textarea => {
            if (!excludedIds.includes(textarea.id)) {
                textarea.value = '';
            }
        });

        Swal.fire({
            icon: 'success',
            title: 'Form Cleared',
            text: 'All fields have been cleared.',
            showConfirmButton: false,
            timer: 1500
        });
    });
});



// -------------------------------save-------------------------------
function saveData() {
    const form = document.getElementById('myForm');
    const formData = new FormData(form);
    let isEmpty = false;

    const typeValue = form.querySelector('select[name="type"]').value.trim(); // Get selected type

    // Function to reset the border on input event
    function resetBorder(event) {
        event.target.style.border = '';
    }

    // Reset all borders first
    form.querySelectorAll('input[type="text"], select').forEach(el => {
        el.style.border = '';
        el.removeEventListener('input', resetBorder);
    });

    // Validate all text inputs
    form.querySelectorAll('input[type="text"]').forEach(input => {
        if (input.value.trim() === "") {
            isEmpty = true;
            input.style.border = '1px solid red';
            input.addEventListener('input', resetBorder);
        }
    });

    // Validate select inputs
    form.querySelectorAll('select').forEach(select => {
        const name = select.getAttribute('name');

        // Skip validation for section and shift if type is "ME"
        if (typeValue === "me" && (name === "section" || name === "shift")) {
            return; // skip validation
        }

        if (select.value.trim() === "") {
            isEmpty = true;
            select.style.border = '1px solid red';
        }
    });

    if (isEmpty) {
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Please fill out all required fields!',
            showConfirmButton: true
        });
        return;
    }

    // Proceed to save via fetch
    fetch('../../process/admin_add_account.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.text();
    })
    .then(data => {
        console.log(data);
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        });
        setTimeout(() => window.location.reload(), 1600);
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Oops...',
            text: 'There was an error saving the data.',
            timer: 1500
        });
    });
}



// ---------------------------------------------------Populate the table COT Start Point---------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    let offset = 0;
    const limit = 10;

    // Load initial table data
    loadTableData(offset, limit);

    // Infinite scroll event only
    document.getElementById('accounts_table_res').addEventListener('scroll', () => {
        const container = document.getElementById('accounts_table_res');
        if (container.scrollTop + container.clientHeight >= container.scrollHeight) {
            offset += limit;
            loadTableData(offset, limit, document.getElementById('searchBox').value.trim());
        }
    });


});



let allData = []; // Array to hold all fetched data

function loadTableData(offset, limit, search = '') {
    fetch(`../../process/admin_accounts.php?offset=${offset}&limit=${limit}&search=${encodeURIComponent(search)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Sort data by 'id'
            data.sort((a, b) => a.id - b.id);

            // Append new data to allData
            allData = allData.concat(data);

            // Populate table with the updated allData
            populateTable(allData);
        })
        .catch(error => console.error('Error fetching data:', error));
}

function populateTable(data) {
    const tbody = document.getElementById('admin_body');
    tbody.innerHTML = ''; // Clear existing rows

    data.forEach(row => {
        const newRow = tbody.insertRow();

        const usernameCell = newRow.insertCell();
        const sectionCell = newRow.insertCell();
        const passwordCell = newRow.insertCell();
        const typeCell = newRow.insertCell();
        const shiftCell = newRow.insertCell(); // NEW: Shift cell
        const deleteCell = newRow.insertCell();

        usernameCell.textContent = row.username;
        sectionCell.textContent = row.section;
        passwordCell.textContent = row.password;
        typeCell.textContent = row.type;
        shiftCell.textContent = row.shift; // NEW: Set shift value

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.className = 'larger-checkbox';
        checkbox.name = 'deleteRow[]';
        checkbox.value = row.username;

        deleteCell.appendChild(checkbox);
        checkbox.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
}


// Assuming there's a delete button in your HTML with id 'deleteBtn'
document.getElementById('deleteBtn').addEventListener('click', function() {
    // Get all checkboxes named 'deleteRow[]'
    const checkboxes = document.querySelectorAll('input[name="deleteRow[]"]:checked');

    // Create an array to store usernames of rows to delete
    const usernamesToDelete = Array.from(checkboxes).map(checkbox => checkbox.value);

    // Show SweetAlert confirmation dialog
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    })
    .then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX request to delete data
            deleteData(usernamesToDelete);
        }
    });
});
$(document).ready(function() {
    // Add event listener to table rows to open modal with data
    $('#admin_body').on('click', 'tr', function(e) {
    const cells = $(this).find('td');

    const username = cells[0].textContent.trim();
    const section = cells[1].textContent.trim();
    const password = cells[2].textContent.trim();
    const type = cells[3].textContent.trim();
    const shift = cells[4].textContent.trim(); // NEW: Shift column

    $('#editUsername').val(username);
    $('#editSection').val(section);
    $('#editPassword').val(password);
    $('#editType').val(type);
    $('#editShift').val(shift); // NEW: Update shift input in modal

    $('#editRecordModal').modal('show');
});

});


function deleteData(usernames) {
    // AJAX request to delete data
    fetch('../../process/admin_delete_account.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ usernames: usernames }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Handle success response if needed
        console.log('Data deleted successfully:', data);
        // Show success message with SweetAlert (no OK button, auto-close after 1500ms)
        Swal.fire({
            title: "Success!",
            text: "Data has been deleted successfully!",
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        }).then(() => {
            // Reload the page after the timer
            location.reload();
        });
    })
    .catch(error => {
        console.error('Error deleting data:', error);
        // Show error message with SweetAlert (auto-close too, optional)
        Swal.fire({
            title: "Error!",
            text: "Failed to delete data. Please try again later.",
            icon: "error",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true
        });
    });
}




    </script>