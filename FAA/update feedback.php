<?php
include('database_connection.php');

// Check if LeaseID is set
if(isset($_REQUEST['feedback_id'])) {
    $feedback_id = $_REQUEST['feedback_id'];
    
    $rms = $connection->prepare("SELECT * FROM feedback WHERE feedback_id = ?");
    $rms->bind_param("i", $feedback_id);
    $rms->execute();
    $result = $rms->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        $y = $row['meeting_id'];
        $z = $row['participant_name'];
        $w = $row['feedback_rating'];
        $o = $row['feedback_comment'];
        $p = $row['feedback_time'];
    } else {
        echo "feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update feedback</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update lease form -->
    <h2><u>Update Form of feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="meeting_id">Meeting ID:</label>
        <input type="text" name="meeting_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="participant_name">Participant Name:</label>
        <input type="text" name="participant_name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="feedback_rating">Feedback Rating:</label>
        <input type="number" name="feedback_rating" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="feedback_comment">Feedback Comment:</label>
        <input type="text" name="feedback_comment" value="<?php echo isset($o) ? $o : ''; ?>">
        <br><br>

        <label for="feedback_time">Feedback Time:</label>
        <input type="datetime-local" name="feedback_time" value="<?php echo isset($p) ? $p : ''; ?>">
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
    $feedback_rating = $_POST['feedback_rating'];
    $feedback_comment = $_POST['feedback_comment'];
    $feedback_time = $_POST['feedback_time'];
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET meeting_id=?, participant_name=?, feedback_rating=?, feedback_comment=?, feedback_time=? WHERE feedback_id=?");
    $stmt->bind_param("issssi", $meeting_id, $participant_name, $feedback_rating, $feedback_comment, $feedback_time, $feedback_id);
    
    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>";
        header('Location: feedback.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
