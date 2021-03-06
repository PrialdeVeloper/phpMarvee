<?php include('config.php'); ?>

 <?php 
          	if(isset($_POST['btnEdit']) && isset($_POST['etxtname']) && isset($_POST['etxtcourse']) && isset($_POST['etxtyear']) && isset($_POST['eid']) ){
          		$id = $_POST['eid'];
          		$name = $_POST['etxtname'];
          		$course = $_POST['etxtcourse'];
          		$year = $_POST['etxtyear'];

          		?>
          		<script type="text/javascript">
          			alert(<?php echo $name; ?>);
          		</script>
          		<?php

          	 	$sql = "UPDATE student SET StudentName = '$name', StudentCourse = '$course', StudentYear = '$year' where sid = $id";
          	 	$res = $db->exec($sql);

          	 	if(!$res){
          	 	?>
          	 	<script type="text/javascript">
          	 		alert('Sorry, Cannot Update specified entry. Please try again later');
          	 	</script>
          	 	<?php	
          	 	}
          	 	else{
          	 	?>
          	 	<script type="text/javascript">
          	 		alert("Successfully Edited");
          	 		window.location = "student.php";
          	 	</script>
          	 	<?php
          	 	$db = null;
          	 	}
          	}
          ?>

<?php 
	if(isset($_POST['btnAdd'])){
		$sname = $_POST['txtname'];
		$scourse = $_POST['txtcourse'];
		$syear = $_POST['txtyear'];
		
		$sql = "INSERT into student(StudentName,StudentCourse,StudentYear) values('$sname','$scourse','$syear')";
		$add = $db->exec($sql);
		if(!$add){
			echo "Error! Data has not been Added";
		}
		elseif($add){
			?>
			<script>
			alert('Data added successfully');
			window.location = 'student.php';
			</script>
			<?php
			$db = null;
		}
	}

	?>
	<script type="text/javascript">
		function confirmfirst(id){
			var x = confirm("Are you sure you want to delete from Database? WARNING: Cannot be undone");
			if(x == true){
				window.location = "student.php?delete="+id;
			}
		}

	</script>
	<?php

	if(isset($_GET['delete'])){
		$delid = $_GET['delete'];
		$find = "select StudentName from student where sid=$delid";
		$r = $db->prepare($find);
		$r->execute();
		$rs = $r->fetchColumn();
		if($rs !=null){
			$del = "delete from student where sid = $delid";
			$delop = $db->prepare($del);
			$delop->execute();
				if($delop){
				?>
				<script>
				alert('Deleted Successfully');
				window.location = 'student.php';
				</script>
				<?php
				}
				else{
				echo "Deleting Error!";
			}
		}
		else{
			?>
				<script>
				alert('Cannot Delete, ID not in database');
				window.location = 'student.php';
				</script>
				<?php
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Form</title>
	 <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	 <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	  <link rel="stylesheet" href="css/bootstrap.css">
	  <script src="js/ajaxjs.js"></script>
	  <script src="js/bootstrapjs.js"></script>
	<style type="text/css">
	body{
		box-sizing: border-box;
	}
	.main{
		margin:50px auto;
		font: 95% Arial, Helvetica, sans-serif;
	    max-width: 450px;
	    padding: 16px;
	}
	table{
		margin-top:-70px;
		margin-left:31.5%;
		margin-right:50px;

	}
	table th{
		width:20%;
	}
	table th p{
		margin-top:3px;
		text-align:center;
	}
	table td{
		width:20%;
		text-align:center;
	}
	body{
	    font-family: 'Lato', sans-serif;
	    background: #f7f7f4;
	}
	.text-center{
	    text-align: center;
	    display:inline;
	    margin-left:-50px;
	}
	.text-right{
		text-align:right;
		margin-top:-60px;

	}
	.btn{
		margin-bottom:20px;
		font-size:12px;
		font-weight: bold;
	}
	tr:nth-child(odd){
		background-color:white;
	}
	tr:nth-child(even){
		background-color:#9CFF88;
		color:green;
	}
	.modal-body input[type="text"],input[type="number"]{
		border:1px solid blue;
		height:40px;
		width:100%;
	}
	.submit{
		margin-top:20px;
		background-color:#53dd18;
		color:white;

	}
	.modal-body p{
		font-size:15px;
		font-weight:bold;

	}
	.search{
		width:50%;
		height:35px;
		background-color:transparent;
		border:1px solid blue;

	}
	.text-right input[type="text"]{
		margin-top:-10px;
	}



	</style>
</head>
<body>
	
	<div class="main">
		
    <div class="text-center">
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Student</button>
    </div>
     <div class="text-right">
     	<form action="#" method="POST">
     	<input type="text" class="search" name="search" placeholder="Search for Name">
         <button type="submit" name="btnsearch" class="btn btn-info btn-lg" >Search</button>
         </form>
    </div>


   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Student</h4>
        </div>
        <form method="POST" action="#">
        <div class="modal-body">
          <p>Student Name</p>
          <input type="text" name="txtname"/>
          <p>Course</p>
          <input type="text" name="txtcourse"/>
          <p>Year</p>
          <input type="number" step="1" min="1" max="5" name="txtyear"/>

        </div>
        <div class="modal-footer">
          <button type="submit" name="btnAdd" class="btn submit btn-default">Add</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>

        </div>
      </div>


      
    </div>
  </div>
  
</div>
<table>
			<tr>
				<th>
					<p>Student ID</p>
				</th>
				<th>
					<p>Student Name</p>
				</th>
				<th>
					<p>Course</p>
				</th>
				<th>
					<p>Year</p>
				</th>
				<th>
					<p>Action</p>
				</th>
			</tr>
	<?php 

	if(isset($_POST['search']) && isset($_POST['btnsearch'])){
		$searchfor = $_POST['search'];
		$all = "SELECT * FROM student where StudentName LIKE '%$searchfor%'";
			$dbData = $db->prepare($all);
			$dbData->execute();

		while($row = $dbData->fetch(PDO::FETCH_ASSOC)){
			$id = $row['sid'];
			$name = $row['StudentName'];
			$course = $row['StudentCourse'];
			$year = $row['StudentYear'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$name."</td>";
			echo "<td>".$course."</td>";
			echo "<td>".$year."</td>";
			echo "<td>";
			?>
			
			<a style="cursor: pointer;" onclick="window.location = 'student.php?edit=<?php echo $id; ?>'">Edit</a>
			<a style="cursor: pointer;" onclick='confirmfirst(<?php echo $id; ?>);'>Delete</a>
			<?php
			echo "</td>";
			echo "</tr>";
			}
			$db = null;
	}
	else
		{
			$all = "SELECT * FROM student";
			$dbData = $db->prepare($all);
			$dbData->execute();

		while($row = $dbData->fetch(PDO::FETCH_ASSOC)){
			$id = $row['sid'];
			$name = $row['StudentName'];
			$course = $row['StudentCourse'];
			$year = $row['StudentYear'];
			echo "<tr>";
			echo "<td>".$id."</td>";
			echo "<td>".$name."</td>";
			echo "<td>".$course."</td>";
			echo "<td>".$year."</td>";
			echo "<td>";
			?>
			
			<a style="cursor: pointer;" onclick="window.location = 'student.php?edit=<?php echo $id; ?>'">Edit</a>
			<a style="cursor: pointer;" onclick='confirmfirst(<?php echo $id; ?>);'>Delete</a>
			<?php
			echo "</td>";
			echo "</tr>";
			}
			$db = null;
		}
	
?>
</table>
	</div>

	  <?php
	  if(isset($_GET['edit'])){
	  	include('config.php');
	  	$editid = $_GET['edit'];

	  	$sql = "SELECT * FROM student WHERE sid = $editid";
	  	$pre = $db->prepare($sql);
	  	$pre->execute();

	  	while ($row = $pre->fetch(PDO::FETCH_ASSOC)) {
	  	$id = $row['sid'];
		$name = $row['StudentName'];
		$course = $row['StudentCourse'];
		$year = $row['StudentYear'];
	  	}

	  	?>
	  <script type="text/javascript">
	  	 $(document).ready(function(){
        $("#myModaledit").modal('show');
    	});
	  </script>

	    <div class="modal fade" id="myModaledit" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Student</h4>
        </div>
        <form method="POST" action="#">
        <div class="modal-body">
          <input type="hidden" name="eid" value="<?php echo $id; ?>">
          <p>Student Name</p>
          <input type="text" name="etxtname" value="<?php echo $name; ?>" />
          <p>Course</p>
          <input type="text" name="etxtcourse" value="<?php echo $course; ?>" />
          <p>Year</p>
          <input type="number" step="1" min="1" max="5" name="etxtyear" value="<?php echo $year; ?>" />

        </div>
        <div class="modal-footer">
          <button type="submit" name="btnEdit" class="btn submit btn-default">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location = 'student.php';">Discard</button>
          </form>

        </div>
      </div>
      
    </div>

	  <?php
	  }
	   ?>
</body>
</html>