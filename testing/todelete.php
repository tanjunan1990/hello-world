<?php 
$con = mysqli_connect("localhost","root","","testingdb");
if (!$con){
    die('Could not connect: ' . mysqli_connect_errno());
}

$id = $_POST["ID"];
$query= $con->prepare("DELETE FROM testtable WHERE ID = ?");
$query->bind_param('s', $id); 

if ($query->execute()){  //execute query
    echo "Query executed, Database updated. ";
    header("location:http://localhost/testing/q2.php");
}else{
    echo $query->error;
    echo "Error executing query.";
    header("location:http://localhost/testing/q2.php");
}

?>