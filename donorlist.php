<?php 
	include 'login_success.php';
?>
<?php 
	require 'dbconnect.php';

// User Input
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 10;

// Positioning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

// Query
$pdo = Database::connect();
$donor = $pdo->prepare("
	SELECT SQL_CALC_FOUND_ROWS * 
	FROM donor 
	ORDER BY dname
	LIMIT {$start},{$perPage}
");
$donor->execute();

$donor = $donor->fetchAll(PDO::FETCH_ASSOC);

// Pages
$total = $pdo->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
$pages = ceil($total / $perPage);
?>
<!--Start of Html-->
<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <style>
    #myInput {
    background-image: url('./img/searchicon.png'); /* Add a search icon to input */
    background-position: 10px 12px; /* Position the search icon */
    background-repeat: no-repeat; /* Do not repeat the icon image */
    width: 3in; /* Full-width */
    font-size: 16px; /* Increase font-size */
    padding: 12px 20px 12px 40px; /* Add some padding */
    border: 1px solid #ddd; /* Add a grey border */
    margin-bottom: 12px; /* Add some space below the input */
}

#myTable {
    border-collapse: collapse; /* Collapse borders */
    width: 100%; /* Full-width */
    border: 1px solid #ddd; /* Add a grey border */
    font-size: 18px; /* Increase font-size */
}

#myTable th, #myTable td {
    text-align: left; /* Left-align text */
    padding: 12px; /* Add padding */
}

#myTable tr {
    /* Add a bottom border to all table rows */
    border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
    /* Add a grey background color to the table header and on hover */
    background-color: #f1f1f1;
}
</style>
	<?php 
		include('header.php');
	?>
	<div class="container">
		<div class="col-lg-offset-1 col-lg-10">
			<div class="row" style="border-bottom:solid 1px;margin-bottom:15px;">
				<div class="col-md-7">
					<h2>Donor List</h2>
				</div>
				<div class="col-md-5 text-right" style="padding-top:20px;">
	                <a href="donorcreate.php" class="btn btn-success btn-md"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;&nbsp; Add New Donor</a>
				</div>
			</div>
			
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
	      		
	      	</form> 
	      
	      	<br>
			<div class="table-responsive">
                            <table class="table table-hover table-striped" id="myTable">
					<thead>
						<tr class="alert-info">
							<th>Donor ID</th>
							<th>Name</th>
							<th>Registration Date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>	
					<tbody>					
						<?php								
							foreach ($donor as $row) {
								echo '<tr>';
									echo '<td>'. $row['did'] . '</td>';
									echo '<td>'.$row['dname'].'</td>';
									echo '<td>'.date('m/d/Y').'</td>';
									echo '<td class="text-center">
													<a class="btn btn-primary btn-md" href="viewdonor.php?id='.$row['did'].'" data-toggle="tooltip" title="Update"><span class="glyphicon glyphicon-edit"></span></a>
									  		  </td>';
								echo '</tr>';
							}
							Database::disconnect();
						?>
					</tbody>
				</table>
                            <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
			</div>
			<nav class="text-center">
				  <ul class="pagination">
					<?php if($page > 1){?>
						<li>
						  <a href="?page=<?php echo $page-1; ?>&per-page=<?php echo $perPage; ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						  </a>
						</li>
					<?php }?>
					
					<?php for($x = 1; $x <= $pages; $x++) : ?>
						<li <?php if($page === $x){ echo 'class="active"'; }?> ><a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage; ?>"><?php echo $x; ?></a></li>
					<?php endfor; ?>
					
					<?php if($page < $pages){?>
						<li>
						  <a href="?page=<?php echo $page+1; ?>&per-page=<?php echo $perPage; ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						  </a>
						</li>
					<?php }?>
					
				  </ul>
			</nav>
		</div>
    </div>
    <!--delete-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document" >
			<div class="modal-content" style="margin-top:40%;">
				<div class="modal-header btn-danger">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Delete Registration</h4>
				</div>
				<form class="form-horizontal" action="./php/donor_delete.php" method="post">
					<div class="modal-body content">
						<input type="text" name="delid" id="deleteTextField" value="<?php echo $id;?>"/>
						<div class="alert alert-danger" role="alert">Are you sure you want to remove this patient from the system?</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
  	</div>

<!--edit @ footer.php-->
<?php
	include('footer.php');
?>
   
</body>
</html>