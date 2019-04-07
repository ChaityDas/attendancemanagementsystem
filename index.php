<?php
include("db.php");
include("header.php");
	$flag=0;
	if (isset($_POST['submit'])) {
		foreach ($_POST['attendance_status'] as $id=>$attendance_status) {
			$studnet_name=$_POST['studnet_name'][$id];
			$roll_number=$_POST['roll_number'][$id];
			$date=date("Y-m-d");
			$result=mysqli_query($con,"insert into attendance_records(studnet_name,roll_number,attendance_status,date) values('$studnet_name','$roll_number','$attendance_status','$date')");
			if ($result) {
				$flag=1;
			}
		}
	}
 ?>

 <div class="panel panel-default">
 	<div class="panel panel-heading">
 		<h2>
 		<a class="btn btn-success" href="add.php">Add Student</a>
 		<a class="btn btn-info" href="view_all.php">View All</a>
 		</h2>
 		<?php if($flag) { ?>
 		<div class="alert alert-success">
 			Attendance Taken Successfuully
 		</div>
 		<?php } ?>
 		<div class="well text-center"><h3><?php echo date("Y-m-d"); ?></h3></div>

 		<div class="panel panel-body">
 			<form action="index.php" method="post">
 				<table class="table table-striped">
 					<tr>
 					<th>#serial Number</th>
 					<th>Student Name</th>
 					<th>Roll Number</th>
 					<th>Attendence Status</th>
 					</tr>
 					<?php 

 					$result=mysqli_query($con,"select * from attendance");
 					$serialnumber=0;
 					$counter=0;
 					while ($row=mysqli_fetch_array($result)) {
 						$serialnumber++;

 						?>
 						<tr>
 						<td><?php echo $serialnumber; ?></td>
 						<td><?php echo $row['studnet_name']; ?></td>
 						<input type="hidden" value="<?php echo $row['studnet_name']; ?>" name="studnet_name[]">
 						<td><?php echo $row['roll_number']; ?></td>
 						<input type="hidden" value="<?php echo $row['roll_number']; ?>" name="roll_number[]">
 						<td>
 							<input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Present"> Present
 							<input type="radio" name="attendance_status[<?php echo $counter; ?>]" value="Absent"> Absent
 						</td>
 						</tr>
 						<?php
 						$counter++;
 					}

 					?>

 				</table>
 				<input type="submit" name="submit" value="submit" class="btn btn-primary">
 			</form>
 		</div>

 	</div>
 </div>