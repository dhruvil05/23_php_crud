<?php

// Include the database configuration file
include_once '../config/db_config.php';

/**
 * Insert data into the database.
 *
 * @param string $firstName
 * @param string $lastName
 * @param string $gender
 * @param string $description
 * @param string $mobileNumber
 * @return bool Returns true on success, false on failure.
 */
function insertData($firstName, $lastName, $gender, $description, $mobileNumber, $file)
{ 
  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];

  global $mysqli;

    // Perform data validation and sanitation here if needed

    // Check if file was uploaded without errors
    if ($fileError === 0) {
      // Move the uploaded file to a specific folder (you may need to create this folder)
      $fileDestination = '../uploads/' . $fileName;
      move_uploaded_file($fileTmpName, $fileDestination);

      // Example SQL query for insertion
      $query = "INSERT INTO user_info (first_name, last_name, gender, description, mobile_number, uploaded_file) 
              VALUES (?, ?, ?, ?, ?, ?)";

      $stmt = $mysqli->prepare($query);

      // Bind parameters
      $stmt->bind_param('ssssss', $firstName, $lastName, $gender, $description, $mobileNumber, $fileDestination);

      // Execute the query
      $result = $stmt->execute();

      // Close the statement
      $stmt->close();

      return $result;
  } else {
      // Handle file upload errors if needed
      return false;
  }
}

/**
 * Retrieve records from the database.
 *
 * @return array Returns an array of records.
 */
function getRecords()
{
    global $mysqli;

    // Example SQL query for retrieval
    $query = "SELECT * FROM user_info";

    $result = $mysqli->query($query);

    $records = [];

    // Fetch records as an associative array
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    // Free the result set
    $result->free();

    return $records;
}

// Add more functions as needed for updating, deleting, or querying specific records
// Ensure to handle errors and security considerations appropriately
