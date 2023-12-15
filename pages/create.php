<?php
include_once '../includes/header.php';
include_once '../scripts/db_functions.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform form validation and database insertion here
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $description = $_POST['description'];
    $mobileNumber = $_POST['mobile_number'];
    $file = $_FILES['file_upload'];

    // Perform form validation and database insertion
    $insertSuccess = insertData($firstName, $lastName, $email, $gender, $description, $mobileNumber, $file);

    if ($insertSuccess) {
        echo '<p class="success-message">Record added successfully!</p>';
        header("Location: http://localhost/23_php_crud/pages/index.php");
    } else {
        echo '<p class="error-message">Error adding record. Please try again.</p>';
    }
}
?>

<h2>Add New Record</h2>

<form action="create.php" method="post" enctype="multipart/form-data">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" required>

    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="gender">Gender:</label>
    <select name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>

    <label for="description">Description:</label>
    <textarea name="description" rows="4" required></textarea>

    <label for="mobile_number">Mobile Number:</label>
    <input type="tel" name="mobile_number" required>

    <label for="file_upload">File Upload:</label>
    <input type="file" name="file_upload">

    <button type="submit">Add Record</button>
</form>

<?php
include_once '../includes/footer.php';
?>
