<?php
include('database_connection.php');

// Check if meeting_id is set
if (isset($_REQUEST['meeting_id'])) {
    $meeting_id = $_REQUEST['meeting_id'];
    
    $rms = $connection->prepare("SELECT * FROM meetings WHERE meeting_id = ?");
    $rms->bind_param("i", $meeting_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['host_name'];
        $z = $row['topic'];
        $w = $row['description'];
        $o = $row['start_time'];
        $p = $row['end_time'];
        $q = $row['duration'];
        $r = $row['status'];
        $s = $row['password_protected'];
        $t = $row['max_attendees'];
    } else {
        echo "Meeting not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Meetings</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <h2><u>Update Form of Meetings</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="host_name">Host Name:</label>
            <input type="text" name="host_name" value="<?php echo isset($y) ? $y : ''; ?>">
            <br><br>

            <label for="topic">Topic:</label>
            <input type="text" name="topic" value="<?php echo isset($z) ? $z : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo isset($w) ? $w : ''; ?>">
            <br><br>

            <label for="start_time">Start Time:</label>
            <input type="datetime-local" name="start_time" value="<?php echo isset($o) ? $o : ''; ?>">
            <br><br>

            <label for="end_time">End Time:</label>
            <input type="datetime-local" name="end_time" value="<?php echo isset($p) ? $p : ''; ?>">
            <br><br>

            <label for="duration">Duration:</label>
            <input type="text" name="duration" value="<?php echo isset($q) ? $q : ''; ?>">
            <br><br>

            <label for="status">Status:</label>
            <input type="text" name="status" value="<?php echo isset($r) ? $r : ''; ?>">
            <br><br>

            <label for="password_protected">Password Protected:</label>
            <input type="number" name="password_protected" value="<?php echo isset($s) ? $s : ''; ?>">
            <br><br>

            <label for="max_attendees">Max Attendees:</label>
            <input type="number" name="max_attendees" value="<?php echo isset($t) ? $t : ''; ?>">
            <br><br>

            <input type="hidden" name="meeting_id" value="<?php echo isset($meeting_id) ? $meeting_id : ''; ?>">
            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    include('database_connection.php');

    // Retrieve updated values from form
    $host_name = $_POST['host_name'];
    $topic = $_POST['topic'];
    $description = $_POST['description'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];
    $password_protected = $_POST['password_protected'];
    $max_attendees = $_POST['max_attendees'];
    $meeting_id = $_POST['meeting_id'];
    
    // Update the meetings in the database
    $stmt = $connection->prepare("UPDATE meetings SET host_name=?, topic=?, description=?, start_time=?, end_time=?, duration=?, status=?, password_protected=?, max_attendees=? WHERE meeting_id=?");
    $stmt->bind_param("ssssssissi", $host_name, $topic, $description, $start_time, $end_time, $duration, $status, $password_protected, $max_attendees, $meeting_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: meetings.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
