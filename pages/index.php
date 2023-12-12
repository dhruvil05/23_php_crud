<?php
include_once '../includes/header.php';
include_once '../scripts/db_functions.php';

// Retrieve records from the database
$records = getRecords();
// echo json_encode($records);

?>

<h2>Record List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Description</th>
            <th>Mobile Number</th>
            <th>File</th>
            <th>Feature</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($records as $record): ?>
            <tr>
                <td><?php echo $record['user_id']; ?></td>
                <td><?php echo $record['first_name']; ?></td>
                <td><?php echo $record['last_name']; ?></td>
                <td><?php echo $record['gender']; ?></td>
                <td><?php echo $record['description']; ?></td>
                <td><?php echo $record['mobile_number']; ?></td>
                <td>
                <?php
                    // Display the image if a filename is present
                    if ($record['uploaded_file']) {
                        $imageUrl = '../uploads/'. $record['uploaded_file'];
                        echo '<img src="'.$imageUrl.'" alt="Image" class="uploaded_file">';
                    } else {
                        echo "No Image";
                    }
                  ?>
                </td>
                <td class="btn_grp">
                  <button class="btn_dlt">Delete</button>
                  <button class="btn_updt">Update</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
include_once '../includes/footer.php';
?>
