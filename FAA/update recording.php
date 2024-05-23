<?php
include('database_connection.php');

// Check if LeaseID is set
if(isset($_REQUEST['recording_id'])) {
    $recording_id = $_REQUEST['recording_id'];
    
    $rms = $connection->prepare("SELECT * FROM recording WHERE recording_id = ?");
    $rms->bind_param("i", $recording_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['meeting_id'];
        $z = $row['recording_url'];
        $w = $row['recording_start_time'];
        $o = $row['recording_end_time'];
        $p = $row['recording_duration'];
    } else {
        echo "recording not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update recording</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update lease form -->
    <h2><u>Update Form of recording</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="meeting_id">Meeting ID:</label>
        <input type="text" name="meeting_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="recording_url">recording_url:</label>
        <input type="text" name="recording_url" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="recording_start_time">recording_start_time:</label>
        <input type="datetime-local" name="recording_start_time" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="recording_end_time">recording_end_time:</label>
        <input type="datetime-local" name="recording_end_time" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <label for="recording_duration">recording_duration:</label>
        <input type="text" name="recording_duration" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    include('database_connection.php');

    // Retrieve updated values from form
    $meeting_id = $_POST['meeting_id'];
    $recording_url = $_POST['recording_url'];
    $recording_start_time = $_POST['recording_start_time'];
    $recording_end_time = $_POST['recording_end_time'];
    $recording_duration = $_POST['recording_duration'];
    
    // Update the recording in the database
    $stmt = $connection->prepare("UPDATE recording SET meeting_id=?, recording_url=?, recording_start_time=?, recording_end_time=?, recording_duration=? WHERE recording_id=?");
    $stmt->bind_param("issssi", $meeting_id, $recording_url, $recording_start_time, $recording_end_time, $recording_duration, $recording_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: recording.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
