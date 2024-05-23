<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
    // Connection details
   include('database_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for customer
    $sql = "SELECT * FROM attendees WHERE attendee_name LIKE '%$searchTerm%'";
    $result_attendees = $connection->query($sql);

    // Perform the search query for employee
    $sql = "SELECT * FROM chatlogs WHERE sender_name LIKE '%$searchTerm%'";
    $result_chatlogs = $connection->query($sql);

    // Perform the search query for landlord
    $sql = "SELECT * FROM feedback WHERE participant_name LIKE '%$searchTerm%'";
    $result_feedback = $connection->query($sql);

    // Perform the search query for lease
    $sql = "SELECT * FROM invitations WHERE sender_name LIKE '%$searchTerm%'";
    $result_invitations = $connection->query($sql);

    // Perform the search query for maintencerequest
    $sql = "SELECT * FROM meetings WHERE meeting_id LIKE '%$searchTerm%'";
    $result_meetings = $connection->query($sql);

     // Perform the search query for payment
    $sql = "SELECT * FROM notifications WHERE participant_name LIKE '%$searchTerm%'";
    $result_notifications = $connection->query($sql);

     // Perform the search query for properties
    $sql = "SELECT * FROM participants WHERE participant_id LIKE '%$searchTerm%'";
    $result_participants = $connection->query($sql);
      // Perform the search query for properties
    $sql = "SELECT * FROM permissions WHERE participant_name LIKE '%$searchTerm%'";
    $result_permissions = $connection->query($sql);
      // Perform the search query for properties
    $sql = "SELECT * FROM recording WHERE recording_url LIKE '%$searchTerm%'";
    $result_recording = $connection->query($sql);
      // Perform the search query for properties
    $sql = "SELECT * FROM settings WHERE participant_name LIKE '%$searchTerm%'";
    $result_settings = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>attendees:</h3>";
    if ($result_attendees->num_rows > 0) {
        while ($row = $result_attendees->fetch_assoc()) {
            echo "<p>" . $row['attendee_name'] . "</p>";
        }
    } else {
        echo "<p>No attendee found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>chatlogs:</h3>";
    if ($result_chatlogs->num_rows > 0) {
        while ($row = $result_chatlogs->fetch_assoc()) {
            echo "<p>" . $row['sender_name'] . "</p>";
        }
    } else {
        echo "<p>No chatlogs found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>feedback:</h3>";
    if ($result_feedback->num_rows > 0) {
        while ($row = $result_feedback->fetch_assoc()) {
            echo "<p>" . $row['participant_name'] . "</p>";
        }
    } else {
        echo "<p>No feedback found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>invitations:</h3>";
    if ($result_invitations->num_rows > 0) {
        while ($row = $result_invitations->fetch_assoc()) {
            echo "<p>" . $row['sender_name'] . "</p>";
        }
     } else {
        echo "<p>No invitations found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>meetings:</h3>";
    if ($result_meetings->num_rows > 0) {
        while ($row = $result_meetings->fetch_assoc()) {
            echo "<p>" . $row['meeting_id'] . "</p>";
        }
     } else {
        echo "<p>No meetings found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>notifications:</h3>";
    if ($result_notifications->num_rows > 0) {
        while ($row = $result_notifications->fetch_assoc()) {
            echo "<p>" . $row['participant_name'] . "</p>";
        }
    } else {
        echo "<p>No notifications found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>participants:</h3>";
    if ($result_participants->num_rows > 0) {
        while ($row = $result_participants->fetch_assoc()) {
            echo "<p>" . $row['participant_id'] . "</p>";
        }
    } else {
        echo "<p>No participant found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>permissions:</h3>";
    if ($result_permissions->num_rows > 0) {
        while ($row = $result_permissions->fetch_assoc()) {
            echo "<p>" . $row[' participant_name'] . "</p>";
        }
    } else {
        echo "<p>No permission found matching the search term: " . $searchTerm . "</p>";
    }
    echo "<h3>recording:</h3>";
    if ($result_recording->num_rows > 0) {
        while ($row = $result_recording->fetch_assoc()) {
            echo "<p>" . $row[' recording_url'] . "</p>";
        }
    } else {
        echo "<p>No recording found matching the search term: " . $searchTerm . "</p>";
    }
    echo "<h3>settings:</h3>";
    if ($result_settings->num_rows > 0) {
        while ($row = $result_settings->fetch_assoc()) {
            echo "<p>" . $row['participant_name'] . "</p>";
        }
    } else {
        echo "<p>No settings found matching the search term: " . $searchTerm . "</p>";
    }
    $connection->close();
} 


else {
    echo "No search term was provided.";
}
?>
