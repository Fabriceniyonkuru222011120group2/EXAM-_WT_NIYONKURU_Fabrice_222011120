<?php
include('database_connection.php');

// Check if LeaseID is set
if(isset($_REQUEST['log_id'])) {
    $log_id = $_REQUEST['log_id'];
    
    $rms = $connection->prepare("SELECT * FROM chatlogs WHERE log_id = ?");
    $rms->bind_param("i", $log_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['message_id'];
        $z = $row['sender_name'];
        $w = $row['meeting_id'];
        $o = $row['message_content'];
        $p = $row['timestamp'];
    } else {
        echo "chatlogs not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update chatlogs</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update lease form -->
    <h2><u>Update Form of chatlogs</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="message_id">message_id:</label>
        <input type="text" name="message_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="sender_name">sender_name:</label>
        <input type="text" name="sender_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="meeting_id">meeting_id :</label>
        <input type="number" name=" meeting_id" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="message_content">message_content:</label>
        <input type="text" name="message_content" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <label for="timestamp"> timestamp:</label>
        <input type="datetime-local" name=" timestamp" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    include('database_connection.php');

    // Retrieve updated values from form
    $message_id = $_POST['message_id'];
    $sender_name = $_POST['sender_name'];
    $meeting_id = $_POST['meeting_id'];
    $message_content = $_POST['message_content'];
    $timestamp = $_POST['timestamp'];
    
    // Update the chatlogs in the database
    $stmt = $connection->prepare("UPDATE chatlogs SET message_id=?, sender_name=?, meeting_id=?, message_content=?,timestamp=? WHERE log_id=?");
    $stmt->bind_param("issssi", $message_id, $sender_name, $meeting_id, $message_content, $timestamp, $log_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: chatlogs.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
