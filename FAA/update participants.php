<?php
include('database_connection.php');

// Check if LeaseID is set
if(isset($_REQUEST['participant_id'])) {
    $participant_id = $_REQUEST['participant_id'];
    
    $rms = $connection->prepare("SELECT * FROM participants WHERE participant_id = ?");
    $rms->bind_param("i", $participant_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['meeting_id'];
        $z = $row['participant_name'];
        $w = $row['join_time'];
        $o = $row['leave_time'];
    } else {
        echo "participant not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update participants</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update lease form -->
    <h2><u>Update Form of participants</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="meeting_id">Meeting ID:</label>
        <input type="text" name="meeting_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="participant_name">Participant Name:</label>
        <input type="text" name="participant_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="join_time">join_time:</label>
        <input type="datetime-local" name="join_time" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="leave_time">leave_time:</label>
        <input type="datetime-local" name="leave_time" value="<?php echo isset($o) ? $o : ''; ?>">
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
    $participant_name = $_POST['participant_name'];
    $join_time = $_POST['join_time'];
    $leave_time = $_POST['leave_time'];
    
    // Update the participants in the database
    $stmt = $connection->prepare("UPDATE participants SET meeting_id=?, participant_name=?, join_time=?, leave_time=? WHERE feedback_id=?");
    $stmt->bind_param("issssi", $meeting_id, $participant_name, $join_time, $leave_time,  $participant_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: participants.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
