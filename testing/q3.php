<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    

<?php
// DATABASE CONNECTION
$con = mysqli_connect("localhost","root","","testingdb"); 
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno());
}
include('q4.php');
$actiontype = $_POST["actiontype"];
$add = $actiontype === "add";
$update = $actiontype === "update";
$delete = $actiontype === "delete";


if($add || $update || $delete ){
	$id = $_POST["ID"];
	$name = $_POST["NAME"];
	$contact = $_POST["CONTACT"];
	$email = $_POST["EMAIL"];
	$dob = $_POST["DOB"];
	if($add){
        if(inputValidation($id,$name,$contact,$email,$dob)){
		$query= $con->prepare("INSERT INTO `testtable`(`ID`, `NAME`, `CONTACT`, `EMAIL`, `DOB`) VALUES (?,?,?,?,?)");
		$query->bind_param('ssiss', $id, $name, $contact, $email, $dob); //bind the parameters
        
		if ($query->execute()){  //execute query
            echo "Query executed. Database updated. ";

		}else{
		    echo $query->error;
		    echo "Error executing query.";
        }
        }
        else{
            echo "Validation Error.";
        }
	}
	else if($update){
        if(inputValidation($id,$name,$contact,$email,$dob)){
		$query= $con->prepare("UPDATE testtable SET NAME=?, CONTACT=?,EMAIL=?,DOB=? WHERE ID =?");
		$query->bind_param('sisss', $name, $contact, $email,$dob, $id); //bind the parameters
        
		if ($query->execute()){  //execute query
		    echo "Query executed. Database updated. ";
		}else{
		    echo $query->error;
		    echo "Error executing query.";
        }
        }
        else{
            echo "Validation Error.";
        }
		
    }else if($delete){  //delete confirmation page
        if(deleteValidation($id)){
	    echo "<form action='todelete.php' method='post'><br>";
	    echo "Are you sure you want to delete item " .$id. "? <br>";
	    echo "<input type='hidden' name='ID' value='" .$id."'>";
	    echo "<input type='submit' value='Delete'>";
        echo"</form>";	
        }
        else{
            echo 'Validation error';


        }
	}
	
}else {
$query= $con->prepare("SELECT ID,NAME,CONTACT,EMAIL,DOB FROM testtable");
$query->execute();
$query->store_result();
$query->bind_result($id, $name, $contact, $email, $dob);
if($query->num_rows === 0) exit('No rows');
echo "<h2>List of products</h2>";
echo "<table border=1>";
echo "<tr><td>ID (&ltFLD_SFX&gt)</td><td>Name (&ltFLD_SFX&gt)</td><td>Contact No (&ltFLD_SFX&gt)</td><td>Email (&ltFLD_SFX&gt)</td><td>DateOfBirth (&ltFLD_SFX&gt)</td></tr>";
while($query->fetch()){
    echo "<tr><td>". $id ."</td><td>". $name ."</td><td>". $contact . "</td><td>". $email. "</td><td>". $dob ."</td></tr>";
}

echo "</table>";
	
}

$con->close();

?>

</body>
</html>