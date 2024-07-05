<?php 
include('../config.php');

echo "<table border='1' class='table'>";

echo "<Tr>
<th><font color='#FFF'>Department</font></th>
<th><font color='#FFF'>Semester</font></th>
<th><font color='#FFF'>Subject Name</font></th>
<th><font color='#FFF'>Teacher Name</font></th>
<th><font color='#FFF'>Date</font></th>

</tr>";

// get user's department id and semester id
$que4 = mysqli_query($con, "select * from student where eid='" . $_SESSION['e_id'] . "'");
$res4 = mysqli_fetch_array($que4);

// fetch semester name using sem_id
$queSem = mysqli_query($con, "select * from semester where sem_id='" . $res4['sem_id'] . "'");
$resSem = mysqli_fetch_array($queSem);
$semesterName = $resSem['semester_name'];




// fetch department name using department_id
$queDepart = mysqli_query($con, "SELECT * FROM department WHERE department_id='" . $res4['department_id'] . "'");
$resDepart = mysqli_fetch_array($queDepart);
// print_r($resDepart[0]);



// fetch time schedules based on user's department id and semester name
$que = mysqli_query($con, "select * from timeschedule where department_name='" . $resDepart['department_name']. "' and semester_name='" . $semesterName . "'");

while ($res = mysqli_fetch_array($que)) {

    echo "<Tr>";

    // display department name
    $que22 = mysqli_query($con, "select * from department where department_id='" . $res['department_name'] . "'");
    $res22 = mysqli_fetch_array($que22);
    echo "<td style='color:white'>" . $res['department_name'] . "</td>";

    // display semester name
    echo "<td style='color:white'>" . $semesterName . "</td>";

    // display subject name
    $que33 = mysqli_query($con, "select * from subject where subject_id='" . $res['subject_name'] . "'");
    $res33 = mysqli_fetch_array($que33);
    echo "<td style='color:white'>" . $res['subject_name'] . "</td>";

    // display teacher name
    $que5 = mysqli_query($con, "select * from teacher where teacher_id='" . $res['teacher_id'] . "'");
    $res5 = mysqli_fetch_array($que5);
    echo "<td style='color:white'>" . $res5['name'] . "</td>";

    echo "<td style='color:white'>" . $res['date'] . "</td>";
    // echo "<td style='color:white'>" . $res['time'] . "</td>";

    echo "</tr>";
}

echo "</table>";  
?>
