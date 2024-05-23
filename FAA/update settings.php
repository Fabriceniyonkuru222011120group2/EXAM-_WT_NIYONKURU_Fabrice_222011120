<?php
include('database_connection.php');

// Check if setting_id is set
if (isset($_REQUEST['setting_id'])) {
    $setting_id = $_REQUEST['setting_id'];
    
    $rms = $connection->prepare("SELECT * FROM settings WHERE setting_id = ?");
    $rms->bind_param("i", $setting_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['participant_name'];
        $z = $row['meeting_id'];
        $w = $row['setting_name'];
        $o = $row['setting_value'];
    } else {
        echo "Setting not found.";
    }
} else {
    echo "No setting ID provided.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Setting</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update setting form -->
    <h2><u>Update Form of Setting</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="participant_name">Participant Name:</label>
        <input type="text" name="participant_name" value="<?php echo isset($y) ? $y : ''; ?>" required>
        <br><br>

        <label for="meeting_id">Meeting ID:</label>
        <input type="text" name="meeting_id" value="<?php echo isset($z) ? $z : ''; ?>" required>
        <br><br>

        <label for="setting_name">Setting Name:</label>
        <input type="text" name="setting_name" value="<?php echo isset($w) ? $w : ''; ?>" required>
        <br><br>

        <label for="setting_value">Setting Value:</label>
        <input type="text" name="setting_value" value="<?php echo isset($o) ? $o : ''; ?>" required>
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    include('database_connection.php');

    // Retrieve updated values from form
    $participant_name = $_POST['participant_name'];
    $meeting_id = $_POST['meeting_id'];
    $setting_name = $_POST['setting_name'];
    $setting_value = $_POST['setting_value'];
    
    // Update the settings in the database
    $stmt = $connection->prepare("UPDATE settings SET participant_name=?, meeting_id=?, setting_name=?, setting_value=? WHERE setting_id=?");
    $stmt->bind_param("ssssi", $participant_name, $meeting_id, $setting_name, $setting_value, $setting_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: settings.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
