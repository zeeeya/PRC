<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="./css/custom_style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.theme.mis.css">
</head>
<!--body starts here-->
<body>
	<!--edit @ header.php-->
	<?php
	include('header.php');
	?>

		<div class="container">
			<div class="col-lg-offset-2 col-lg-8 col-lg-offset-2">
				<div class="row">
					<h2 style="text-align: center;">Register New PRC User</h2>
					<br />
				</div>
						
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4>PRC User's Profile</h4>
					</div>
					
					<div class="panel-body">
						<form class="form-horizontal" action="./php/reguser.php" method="post">

							<!-- Text input-->
							<div class="control-group">
							  <label class="control-label" for="fname">First Name</label>
							  <div class="controls">
							    <input id="fname" name="fname" type="text" placeholder="first name" class="form-control" required="">
							    
							  </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label" for="mname">Middle Name</label>
							  <div class="controls">
							    <input id="mname" name="mname" type="text" placeholder="middle name" class="form-control" required="">
							    
							  </div>
							</div>
                                                        <div class="control-group">
							  <label class="control-label" for="lname">Last Name</label>
							  <div class="controls">
							    <input id="lname" name="lname" type="text" placeholder="last name" class="form-control" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="control-group">
							  <label class="control-label" for="username">Username</label>
							  <div class="controls">
							    <input id="username" name="username" type="text" placeholder="Username" class="form-control" required="">
							    
							  </div>
							</div>

							<!-- Text input-->
							<div class="control-group">
							  <label class="control-label" for="password">Password</label>
							  <div class="controls">
                                                              <input id="password" name="password" type="password" class="form-control" required="">
							    
							  </div>
							</div>


							<!-- Select Basic -->
							<div class="control-group">
							  <label class="control-label" for="usertype">User Type</label>
							  <div class="controls">
							    <select id="usertype" name="usertype" class="form-control">
							      <option>Admin</option>
                                                              <option>PRC User</option>
							    </select>
							  </div>
							</div>

							
					</div>
							<!--Buttons-->
							<div class="panel-footer">	
								<div class="form-actions text-center forms">
									<button type="submit" class="btn btn-success">Submit</button>
									<a class="btn" href="home.php">Back</a>
								</div>		
						  	</div>		
						</form>
					</div>
				</div>		
			</div>
		</div>
	
<!--edit @ footer.php-->
<?php
	include('footer.php');
?>
</body>
</html>
