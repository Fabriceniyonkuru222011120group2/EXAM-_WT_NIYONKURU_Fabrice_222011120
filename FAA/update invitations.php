<?php
include('database_connection.php');

// Check if LeaseID is set
if(isset($_REQUEST['invitation_id'])) {
    $invitation_id = $_REQUEST['invitation_id'];
    
    $rms = $connection->prepare("SELECT * FROM invitations WHERE invitation_id = ?");
    $rms->bind_param("i", $invitation_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['sender_name'];
        $z = $row['recipient_name'];
        $w = $row['meeting_id'];
        $o = $row['invitation_status'];
        $p = $row['invitation_time'];
    } else {
        echo "invitation not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update invitation</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update lease form -->
    <h2><u>Update Form of invitation</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="sender_name">sender_name:</label>
        <input type="text" name="sender_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="recipient_name">recipient_name:</label>
        <input type="text" name="recipient_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="meeting_id">meeting_id:</label>
        <input type="number" name="meeting_id" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="invitation_status">invitation_status:</label>
        <input type="text"name="invitation_status" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <label for="invitation_time">invitation_time:</label>
        <input type="datetime-local" name="invitation_time" value="<?php echo isset($p) ? $p : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    include('database_connection.php');

    // Retrieve updated values from form
    $sender_name = $_POST['sender_name'];
    $recipient_name = $_POST['recipient_name'];
    $meeting_id = $_POST['meeting_id'];
    $invitation_status = $_POST['invitation_status'];
    $invitation_time = $_POST['invitation_time'];
    
    // Update the invitations in the database
    $stmt = $connection->prepare("UPDATE invitations SET sender_name=?, recipient_name=?, meeting_id=?, invitation_status=?, invitation_time=? WHERE invitation_id =?");
    $stmt->bind_param("issssi", $sender_name, $recipient_name, $meeting_id, $invitation_status, $invitation_time, $invitation_id );
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: invitations.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
