<?php
include('database_connection.php');

// Check if permission_id is set
if (isset($_REQUEST['permission_id'])) {
    $permission_id = $_REQUEST['permission_id'];
    
    $stmt = $connection->prepare("SELECT * FROM permissions WHERE permission_id = ?");
    $stmt->bind_param("i", $permission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['participant_name'];
        $z = $row['meeting_id'];
        $w = $row['permission_type'];
        $o = $row['granted_by_user_name'];
    } else {
        echo "Permission not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Permissions</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update permissions form -->
    <h2><u>Update Form of Permissions</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="participant_name">Participant Name:</label>
        <input type="text" name="participant_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="meeting_id">Meeting ID:</label>
        <input type="text" name="meeting_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="permission_type">Permission Type:</label>
        <input type="text"name="permission_type" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="granted_by_user_name">Granted By User Name:</label>
        <input type="text" name="granted_by_user_name" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $participant_name = $_POST['participant_name'];
    $meeting_id = $_POST['meeting_id'];
    $permission_type = $_POST['permission_type'];
    $granted_by_user_name = $_POST['granted_by_user_name'];
    
    // Update the permissions in the database
    $stmt = $connection->prepare("UPDATE permissions SET participant_name = ?, meeting_id = ?, permission_type= ?, granted_by_user_name = ? WHERE permission_id = ?");
    $stmt->bind_param("ssssi", $participant_name, $meeting_id, $permission_type, $granted_by_user_name, $permission_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: permissions.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close(); // Close the database connection
?>
