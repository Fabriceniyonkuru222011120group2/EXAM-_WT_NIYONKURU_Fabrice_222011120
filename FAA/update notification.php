<?php
include('database_connection.php');

// Check if notification_id is set
if (isset($_REQUEST['notification_id'])) {
    $notification_id = $_REQUEST['notification_id'];
    
    $rms = $connection->prepare("SELECT * FROM notifications WHERE notification_id = ?");
    $rms->bind_param("i", $notification_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['participant_name'];
        $z = $row['notification_content'];
        $w = $row['timestamp'];
        $o = $row['read_status'];
    } else {
        echo "Notification not found.";
    }
} else {
    echo "No notification ID provided.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Notification</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <!-- Update notification form -->
    <h2><u>Update Form of Notifications</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="participant_name">Participant Name:</label>
        <input type="text" name="participant_name" value="<?php echo isset($y) ? $y : ''; ?>" required>
        <br><br>

        <label for="notification_content">Notification Content:</label>
        <input type="text" name="notification_content" value="<?php echo isset($z) ? $z : ''; ?>" required>
        <br><br>

        <label for="timestamp">Timestamp:</label>
        <input type="datetime-local" name="timestamp" value="<?php echo isset($w) ? $w : ''; ?>" required>
        <br><br>

        <label for="read_status">Read Status:</label>
        <input type="text" name="read_status" value="<?php echo isset($o) ? $o : ''; ?>" required>
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
    $notification_content = $_POST['notification_content'];
    $timestamp = $_POST['timestamp'];
    $read_status = $_POST['read_status'];
    
    // Update the notification in the database
    $stmt = $connection->prepare("UPDATE notifications SET participant_name=?, notification_content=?, timestamp=?, read_status=? WHERE notification_id=?");
    $stmt->bind_param("ssssi", $participant_name, $notification_content, $timestamp, $read_status, $notification_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: notification.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
