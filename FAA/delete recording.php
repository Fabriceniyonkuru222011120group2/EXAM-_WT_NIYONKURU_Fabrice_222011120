
<?php
include('database_connection.php');

// Check if Product_Id is set
if(isset($_REQUEST['recording_id '])) {
    $recording_id  = $_REQUEST['recording_id '];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM recording WHERE recording_id =?");
    $stmt->bind_param("i", $recording_id );
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name=" recording_id " value="<?php echo $recording_id ; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "recording_id  is not set.";
}

$connection->close();
?>