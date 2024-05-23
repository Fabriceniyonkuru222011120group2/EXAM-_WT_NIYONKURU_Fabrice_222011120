<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Feedback</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: skyblue;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */
      padding: 8px;
    }
    section{
      padding:180px;
    }
    header{
      background-color: #F4A460;
      padding: 20px;
    }
    footer{
      background-color: #F4A460;
      padding: 20px;
    }

    /* Dropdown container */
    .dropdown {
      float: right; /* Align to the right */
      margin-right: 100px; /* Adjust margin as needed */
      position: relative;
    }

    /* Dropdown content */
    .dropdown-contents {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    /* Show dropdown content on hover */
    .dropdown:hover .dropdown-contents {
      display: block;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
  <script>
    function confirmInsert() {
      return confirm('Are you sure you want to insert this record?');
    }
  </script>
</head>
<body bgcolor="darkcyan">
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./meetings.php">Meeting</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./participants.php">Participant</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./recording.php">Recording</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./chatlogs.php">Chatlogs</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./invitations.php">Invitation</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./permissions.php">Parmission</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./settings.php">settings</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">Feedback</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./notification.php">Notification</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">Attendee</a></li>
      <li class="dropdown">
        <a href="#" style="color: white; background-color: darkgreen; text-decoration: none; margin-right: 15px;">Settings</a>
        <div class="dropdown-contents">
          <!-- Links inside the dropdown menu -->
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>

  <h1>Feedback Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="feedback_id">Feedback ID:</label>
    <input type="number" id="feedback_id" name="feedback_id" required><br><br>

    <label for="meeting_id">Meeting ID:</label>
    <input type="number" id="meeting_id" name="meeting_id" required><br><br>

    <label for="participant_name">Participant Name:</label>
    <input type="text" id="participant_name" name="participant_name" required><br><br>

    <label for="feedback_rating">Feedback Rating:</label>
    <input type="number" id="feedback_rating" name="feedback_rating" required><br><br>

    <label for="feedback_comment">Feedback Comment:</label>
    <textarea id="feedback_comment" name="feedback_comment" required></textarea><br><br>

    <label for="feedback_time">Feedback Time:</label>
    <input type="datetime-local" id="feedback_time" name="feedback_time" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Gather form data
    $feedback_id = $_POST['feedback_id'];
    $meeting_id = $_POST['meeting_id'];
    $participant_name = $_POST['participant_name'];
    $feedback_rating = $_POST['feedback_rating'];
    $feedback_comment = $_POST['feedback_comment'];
    $feedback_time = $_POST['feedback_time'];

    // Prepare and execute the SQL insert statement
    $stmt = $connection->prepare("INSERT INTO feedback (feedback_id, meeting_id, participant_name, feedback_rating, feedback_comment, feedback_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisiss", $feedback_id, $meeting_id, $participant_name, $feedback_rating, $feedback_comment, $feedback_time);

    if ($stmt->execute()) {
      echo "New record has been added successfully.<br><br><a href='feedback.php'>Back to Form</a>";
    } else {
      echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
  }
  ?>

  <section>
    <h2>Feedback Detail</h2>
    <table>
      <tr>
        <th>Feedback ID</th>
        <th>Meeting ID</th>
        <th>Participant Name</th>
        <th>Feedback Rating</th>
        <th>Feedback Comment</th>
        <th>Feedback Time</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Fetch and display feedback records
      $result = $connection->query("SELECT * FROM feedback");

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['feedback_id']}</td>
                  <td>{$row['meeting_id']}</td>
                  <td>{$row['participant_name']}</td>
                  <td>{$row['feedback_rating']}</td>
                  <td>{$row['feedback_comment']}</td>
                  <td>{$row['feedback_time']}</td>
                  <td><a style='padding:4px' href='delete feedback.php?feedback_id={$row['feedback_id']}'>Delete</a></td>
                  <td><a style='padding:4px' href='update feedback.php?feedback_id={$row['feedback_id']}'>Update</a></td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='8'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <center>
      <b><h2><i>UR CBE BIT &copy; prepared by FABRICE NIYONKURU</i></h2></b>
    </center>
  </footer>
</body>
</html>
