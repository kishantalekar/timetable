<?php 
session_start();
include('../config.php');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check session
if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

// Function to delete data
echo '
<script>
    function deleteData(id) {
        if (confirm("You want to delete ?")) {
            window.location.href = "deletesemester.php?sem_id=" + id;
        }
    }
</script>';

// Display table
echo "<table border='1' class='table'>";
echo "<tr class='danger'><th colspan='5'><a href='admindashboard.php?info=add_semester'>Add New</a></th></tr>";
echo "<tr><th>Sem Id</th><th>Semester</th><th>Department</th><th>Update</th><th>Delete</th></tr>";

// Query the semester table
$que = mysqli_query($con, "SELECT * FROM semester");
if (!$que) {
    die("Error fetching semesters: " . mysqli_error($con));
}

// Loop through the results and display each row
while ($res = mysqli_fetch_array($que)) {
    echo "<tr>";
    echo "<td>{$res['sem_id']}</td>";
    echo "<td>{$res['semester_name']}</td>";

    // Query the department table to get the department name
    $que1 = mysqli_query($con, "SELECT * FROM department WHERE department_id='{$res['department_id']}'");
    if (!$que1) {
        die("Error fetching department: " . mysqli_error($con));
    }
    $res1 = mysqli_fetch_array($que1);
    echo "<td>{$res1['department_name']}</td>";
    echo "<td><a href='admindashboard.php?info=updatesemester&sem_id={$res['sem_id']}'>Update</a></td>";
    echo "<td><a href='javascript:deleteData(\"{$res['sem_id']}\")'>Delete</a></td>";
    echo "</tr>";
}

echo "</table>";
?>
