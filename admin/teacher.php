<script>
	function deleteData(id) {
		if (confirm("You want to delete ?")) {
			window.location.href = "deleteteacher.php?teacher_id=" + id;
		}
	}
</script>

<?php 
session_start();
include('../config.php');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Display table
echo "<table border='1' class='table'>";
echo "<tr class='danger'><th colspan='11'><a href='admindashboard.php?info=add_teacher'>Add New</a></th></tr>";
echo "<tr><th>Teacher Id</th><th>Teacher Name</th><th>Email</th><th>Password</th><th>Mobile</th>
<th>Address</th><th>Department</th><th>Update</th><th>Delete</th></tr>";

$que = mysqli_query($con, "SELECT * FROM teacher");
if (!$que) {
    die("Error fetching teachers: " . mysqli_error($con));
}

while ($res = mysqli_fetch_array($que)) {
    echo "<tr>";
    echo "<td>" . $res['teacher_id'] . "</td>";
    echo "<td>" . $res['name'] . "</td>";
    echo "<td>" . $res['eid'] . "</td>";
    echo "<td>" . $res['password'] . "</td>";
    echo "<td>" . $res['mob'] . "</td>";
    echo "<td>" . $res['address'] . "</td>";
    
    // Display department name
    $que2 = mysqli_query($con, "SELECT * FROM department WHERE department_id='" . $res['department_id'] . "'");
    if (!$que2) {
        die("Error fetching department: " . mysqli_error($con));
    }
    $res2 = mysqli_fetch_array($que2);
    echo "<td>" . $res2['department_name'] . "</td>";
    
    // Display semester name
    // $que1 = mysqli_query($con, "SELECT * FROM semester WHERE sem_id='" . $res2['sem_id'] . "'");
    // if (!$que1) {
    //     die("Error fetching semester: " . mysqli_error($con));
    // }
    // $res1 = mysqli_fetch_array($que1);
    
    echo "<td><a href='admindashboard.php?info=updateteacher&teacher_id=" . $res['teacher_id'] . "'>Update</a></td>";
    ?>
    
    <td><a href='javascript:deleteData("<?php echo $res['teacher_id']; ?>")'>Delete</a></td>
    <?php 
    echo "</tr>";
}

echo "</table>";
?>
