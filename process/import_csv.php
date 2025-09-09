<?php
include 'conn.php'; // Include your connection file

function importCSV($csvFilePath) {
    global $conn;

    // Check if file exists
    if (!file_exists($csvFilePath)) {
        die("File does not exist: " . $csvFilePath);
    }

    // Open the CSV file
    if (($handle = fopen($csvFilePath, "r")) !== false) {
        
        // Skip the first row if it contains headers (optional)
        fgetcsv($handle); // Uncomment if your CSV has a header row

        // Loop through each row in the CSV file
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Assuming CSV columns are in order: username, password, section, type
            $username = $data[0];
            $password = $data[1];
            $section = $data[2];
            $type = $data[3];

            // SQL query with placeholders
            $query = "INSERT INTO [dbo].[account] ([username], [password], [section], [type]) VALUES (?, ?, ?, ?)";

            // Prepare the SQL statement
            $stmt = sqlsrv_query($conn, $query, array($username, $password, $section, $type));

            if ($stmt === false) {
                echo "Error executing query: ";
                die(print_r(sqlsrv_errors(), true));
            }
        }

        // Close the file and statement
        fclose($handle);
        sqlsrv_free_stmt($stmt);

        echo "CSV data imported successfully!";
    } else {
        echo "Error opening the file.";
    }
}

// Call the function with your CSV file path
importCSV("C:/xampp/htdocs/secondary_system/your_folder/your_file.csv");
?>
