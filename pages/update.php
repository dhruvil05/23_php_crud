<?php
include_once '../includes/header.php';
include_once '../scripts/db_functions.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Perform form validation and database insertion here
    $id = $_GET['update'];
    $records = getUpdateData($id);
   
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $id = $_POST['update_id'];
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $description = $_POST['description'];
  $mobileNumber = $_POST['mobile_number'];
  $file = $_FILES['file_upload'];

  // Perform form validation and database insertion
  $updateSuccess = updateData($firstName, $lastName, $email, $gender, $description, $mobileNumber, $id);

  if ($updateSuccess) {
      echo '<p class="success-message">Record updated successfully!</p>';
      header("Location: http://localhost/23_php_crud/pages/index.php");
  } else {
      echo '<p class="error-message">Error adding record. Please try again.</p>';
  }
  
}
?>

<h2>Update New Record</h2>

<form action="update.php" method="post" enctype="multipart/form-data">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo isset($records[0]['first_name'])? $records[0]['first_name']:""; ?>" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="<?php echo isset($records[0]['last_name'])?$records[0]['last_name']:""; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo isset($records[0]['email'])?$records[0]['email']:""; ?>" required>

    <label for="gender">Gender:</label>
    <select name="gender" required>
        <option value="male" <?php echo isset($records[0]['gender'])? $records[0]['gender']=='male': "selected"; ?>>Male</option>
        <option value="female" <?php echo isset($records[0]['gender'])? $records[0]['gender']=='female': "selected"; ?>>Female</option>
        <option value="other" <?php isset($records[0]['gender'])? $records[0]['gender']=='other': "selected"; ?>>Other</option>
    </select>

    <label for="description">Description:</label>
    <textarea name="description" rows="4" required> <?php echo isset($records[0]['description'])?$records[0]['description']:""; ?> </textarea>

    <label for="mobile_number">Mobile Number:</label>
    <input type="tel" name="mobile_number" value="<?php echo isset($records[0]['mobile_number'])?$records[0]['mobile_number']:""; ?>" required>

    <label for="file_upload">File Upload:</label>
    <input type="file" name="file_upload">

    <button type="submit" name="update_id" value="<?php echo $records[0]['user_id']; ?>">Update Record</button>
</form>

<?php
include_once '../includes/footer.php';
?>
