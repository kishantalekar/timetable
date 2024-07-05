<script>
	function deleteData(id) {
		if(confirm("You want to delete ?")) {
			window.location.href = "deletecourse.php?course_id=" + id;
		}
	}
</script>

<?php 
include('../config.php');

// Display data
echo "<table border='1' class='table table-striped'>";

echo "<tr class='danger'><th colspan='4'><a href='admindashboard.php?info=add_course'>Add New</a></th></tr>";

echo "<tr><th>Id</th><th>Department</th><th>Update</th><th>Delete</th></tr>";

$que = mysqli_query($con, "SELECT * FROM department");
while ($res = mysqli_fetch_array($que)) {
	echo "<tr>";
	echo "<td>" . $res['department_id'] . "</td>";
	echo "<td>" . $res['department_name'] . "</td>";
	echo "<td><a href='admindashboard.php?info=updatecourse&department_id=" . $res['department_id'] . "'>Update</a></td>";
	echo "<td><a href='javascript:deleteData(" . $res['department_id'] . ")'>Delete</a></td>";
	echo "</tr>";
}

echo "</table>";	
?>
