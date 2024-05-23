<?php
include('database_connection.php');

// Check if LeaseID is set
if(isset($_REQUEST['attendee_id'])) {
    $attendee_id = $_REQUEST['attendee_id'];
    
    $rms = $connection->prepare("SELECT * FROM attendees WHERE attendee_id = ?");
    $rms->bind_param("i", $attendee_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['meeting_id'];
        $z = $row['attendee_name'];
        $w = $row['join_time'];
        $o = $row['leave_time'];
    } else {
        echo "attendees not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update attendees</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update lease form -->
    <h2><u>Update Form of attendees</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="meeting_id">Meeting ID:</label>
        <input type="text" name="meeting_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="attendee_name ">attendee_name :</label>
        <input type="text" name="attendee_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="join_time">join_time:</label>
        <input type="datetime-local" name=" join_time" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $attendee_name = $_POST['attendee_name'];
    $join_time = $_POST['join_time'];
    $leave_time = $_POST['leave_time'];
    
    // Update the attendees in the database
    $stmt = $connection->prepare("UPDATE attendees SET meeting_id=?, attendee_name=?, join_time=?, leave_time=? WHERE attendee_id=?");
    $stmt->bind_param("isssi", $meeting_id, $attendee_name, $join_time, $leave_time, $attendee_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: attendees.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
