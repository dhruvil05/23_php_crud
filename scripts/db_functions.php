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
function insertData($firstName, $lastName, $email, $gender, $description, $mobileNumber, $file)
{ 
  $fileName = time().'.png';
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  
  global $mysqli;

  if ($fileError === 0) {

    $fileDestination = '../uploads/' . $fileName;
    move_uploaded_file($fileTmpName, $fileDestination);

    $query = "INSERT INTO user_info (first_name, last_name, email, gender, description, mobile_number, uploaded_file) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($query);

    $stmt->bind_param('sssssss', $firstName, $lastName, $email, $gender, $description, $mobileNumber, $fileDestination);

    $result = $stmt->execute();

    $stmt->close();

    return $result;
  } else {
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

    $query = "SELECT * FROM user_info";

    $result = $mysqli->query($query);

    $records = [];

    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    $result->free();

    return $records;
}

function deleteData($id)
{
  global $mysqli;

  $query = "SELECT * FROM user_info where user_id = $id";

  $result = $mysqli->query($query) or die($mysqli->error);
  $rowCount = $result->num_rows;        // Count rows got by query.
  
  if($rowCount > 0){

    while ($row = $result->fetch_assoc()) {
      $filePath = $row['uploaded_file'];

      if (file_exists($filePath)) {

        if (unlink($filePath)) {
          $query = "DELETE FROM user_info WHERE user_id = ?";
          $stmt = $mysqli->prepare($query);

          $stmt->bind_param('i', $id);

          $result = $stmt->execute();

          $stmt->close();
          getRecords();
        } else {
            echo "Error deleting image file";
        }
      } else {
          echo "File does not exist";
      }
    }
  }else {
    echo "Data not available.";
  }
}
// Add more functions as needed for updating, deleting, or querying specific records
// Ensure to handle errors and security considerations appropriately
function getUpdateData($id){
  global $mysqli;

  $query = "SELECT * FROM user_info WHERE user_id = $id";

  $result = $mysqli->query($query);

  $records = [];

  while ($row = $result->fetch_assoc()) {
      $records[] = $row;
  }

  $result->free();

  return $records;
}

function updateData($firstName, $lastName, $email, $gender, $description, $mobileNumber, $id){
  
  global $mysqli;
  $query = "UPDATE user_info SET first_name=?, last_name=?, email=?, gender=?, description=?, mobile_number=? WHERE user_id = ?";

  $stmt = $mysqli->prepare($query);

  $stmt->bind_param('ssssssi', $firstName, $lastName, $email, $gender, $description, $mobileNumber, $id);

  $result = $stmt->execute();

  $stmt->close();

  return $result;
  
}