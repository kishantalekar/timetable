<script>
	function deleteData(id)
	{
		if(confirm("You want to delete ?"))
		{
			window.location.href="deletesubject.php?subject_id="+id;
		}
	}
</script>

<?php 
include('../config.php');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

echo "<table border='1' class='table'>";

echo "<tr class='danger'><th colspan='9'><a href='admindashboard.php?info=add_subject'>Add New</a></th></tr>";

echo "<tr><th>Subject Id</th><th>Subject Name</th><th>Semester</th><th>Department</th><th>Teacher</th>
<th>Lecture/Week</th><th>Type</th><th>Update</th><th>Delete</th></tr>";

$que = mysqli_query($con, "SELECT * FROM subject");
if (!$que) {
	die("Error executing query: " . mysqli_error($con));
}

while ($res = mysqli_fetch_array($que)) {
	echo "<tr>";
	echo "<td>".$res['subject_id']."</td>";
	echo "<td>".$res['subject_name']."</td>";

	// Display semester name
	$que1 = mysqli_query($con, "SELECT * FROM semester WHERE sem_id='".$res['sem_id']."'");
	if (!$que1) {
		echo "<td>Error fetching semester</td>";
	} else {
		$res1 = mysqli_fetch_array($que1);
		echo "<td>".$res1['semester_name']."</td>";
	}

	// Display department name
	$que2 = mysqli_query($con, "SELECT * FROM department WHERE department_id='".$res['department_id']."'");
	if (!$que2) {
		echo "<td>Error fetching department</td>";
	} else {
		$res2 = mysqli_fetch_array($que2);
		echo "<td>".$res2['department_name']."</td>";
	}

	// Display teacher name
	$que3 = mysqli_query($con, "SELECT * FROM teacher WHERE teacher_id='".$res['teacher_id']."'");
	if (!$que3) {
		echo "<td>Error fetching teacher</td>";
	} else {
		$res3 = mysqli_fetch_array($que3);
		echo "<td>".$res3['name']."</td>";
	}

	echo "<td>".$res['lecture_per_week']."</td>";
	echo "<td>".$res['type']."</td>";
	echo "<td><a href='admindashboard.php?info=updatesubject&subject_id=".$res['subject_id']."'>Update</a></td>";
	echo "<td><a href='javascript:deleteData(\"".$res['subject_id']."\")'>Delete</a></td>";
	echo "</tr>";
}

echo "</table>";	
?>
