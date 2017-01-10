<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <body>
<?php
include 'header.php';
?>
        <br><br>
        
    <center> 
        <div style="background-color: white; width: 5in; height: 5in">
<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
          <br><br>
        <label for="exampleInputFile" style="font-family: times new roman; font-size: 30px">Import File.</label>
        <br><br><br><br>
        <input type="file" name="file" id="file">
        <br><br>
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <br>
    <button type="submit" class="btn btn-default" name="Import" value="Import" style="background-color: #ffcc66 ;height: 1in; width: 3in; font-family: times new roman; font-size: 30px">Upload</button>
</form>
        </div>
    </center>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
if(isset($_POST["Import"]))
{
    //First we need to make a connection with the database
    $host='localhost'; // Host Name.
    $db_user= 'root'; //User Name
    $db_password= '';
    $db= 'prcbbmis'; // Database Name.
    $conn=mysql_connect($host,$db_user,$db_password) or die (mysql_error());
    mysql_select_db($db) or die (mysql_error());
    echo $filename=$_FILES["file"]["tmp_name"];
    if($_FILES["file"]["size"] > 0)
    {
        $file = fopen($filename, "r");
        //$sql_data = "SELECT * FROM prod_list_1 ";
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            //print_r($emapData);
            //exit();
            $sql = "INSERT into user(fname, mname, lname, username, password, usertype) values ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]')";
            mysql_query($sql);
        }
        fclose($file);
        echo 'CSV File has been successfully Imported';
        header('Location: import.php');
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>
    <?php 
		include('footer.php');
	?>
    </body>
</html>
