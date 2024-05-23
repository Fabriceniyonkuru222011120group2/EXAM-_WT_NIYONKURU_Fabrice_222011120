<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Permisions</title>
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
<body style="background-image: url('./images./);background-repeat: no-repeat;background-size:cover;">


<header>


<!-- <div class="col-3 offset">-->
<form class="d-flex" role="search" action="search.php">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name ="query">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">


      <a href="./home.html">HOME</a>
    </li>
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

<body bgcolor="darkcyan">
  <!-- Your header code here -->

  <h1>Permissions Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="permission_id">Permission ID:</label>
    <input type="number" id="permission_id" name="permission_id" required><br><br>

    <label for="participant_name">Participant Name:</label>
    <input type="text" id="participant_name" name="participant_name" required><br><br>

    <label for="meeting_id">Meeting ID:</label>
    <input type="number" id="meeting_id" name="meeting_id" required><br><br>

    <label for="permission_type">Permission Type:</label>
    <input type="text" id="permission_type"name="permission_type"required><br><br>

    <label for="granted_by_user_name">Granted By User Name:</label>
    <input type="text" id="granted_by_user_name" name="granted_by_user_name" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a> 
  </form>

  <?php
  include('database_connection.php'); 

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
      // Gather form data
      $permission_id = $_POST['permission_id'];
      $participant_name = $_POST['participant_name'];
      $meeting_id = $_POST['meeting_id'];
      $permission_type= $_POST['permission_type'];
      $granted_by_user_name = $_POST['granted_by_user_name'];

      // Prepare and execute the SQL insert statement
      $stmt = $connection->prepare("INSERT INTO permissions (permission_id, participant_name, meeting_id, permission_type, granted_by_user_name) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $permission_id, $participant_name, $meeting_id, $permission_type, $granted_by_user_name);

      if ($stmt->execute()) {
          echo "New record has been added successfully.<br><br><a href='permissions.php'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }
  ?>

  <section>
    <h2>Permissions Detail</h2>
    <table>
      <tr>
        <th>Permission ID</th>
        <th>Participant Name</th>
        <th>Meeting ID</th>
        <th>Permission Type</th>
        <th>Granted By User Name</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      // Fetch and display permissions records
      $sql = "SELECT * FROM permissions";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['permission_id']}</td>
                      <td>{$row['participant_name']}</td>
                      <td>{$row['meeting_id']}</td>
                      <td>{$row['permission_type']}</td>
                      <td>{$row['granted_by_user_name']}</td>
                      <td><a style='padding:4px' href='delete permissions.php?permission_id={$row['permission_id']}'>Delete</a></td> 
                      <td><a style='padding:4px' href='update permissions.php?permission_id={$row['permission_id']}'>Update</a></td> 
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }
      ?>
    </table>
  </section>
 <footer>
<center>
      <b><h2><i> UR CBE BIT &copy, prepared by FABRICE NIYONKURU </h2></b></i>
  </center>
    </footer>
  <!-- Your footer code here -->
</body>
</html>
