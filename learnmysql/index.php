<html>
<!-- Server Connection -->
<?php
$mysql_host="localhost";
$mysql_user="root";
$mysql_password="";
$mysql_db="tpshop";

$con= new mysqli($mysql_host,$mysql_user,$mysql_password,$mysql_db);
if(!$con){
    echo $con->errno . "<br>";
    die('Could not connect: '. $con->error);
}
else {
    echo "Connection to $mysql_db at $mysql_host successful<br>";
}
?>
<!-- Check if fields are empty -->
<?php
if (isset($_POST['Submit']) && $_POST['Submit'] === "Submit"){
    // <!-- INSERT function -->
	 if(!empty($_POST['ITEM_NAME']) &&
		!empty($_POST['STOCK']) &&
		!empty($_POST['UNITPRICE']) &&
		!empty($_POST['COSTPRICE']) &&
		!empty($_POST['SHORT_DESC']) &&
		!empty($_POST['MERCHANT'])) 
		{
			echo "OK: fields are not empty<br>";

			$itemname=$_POST['ITEM_NAME'];
			$stock=$_POST['STOCK'];
			$unitprice=$_POST['UNITPRICE'];
			$costprice=$_POST['COSTPRICE'];
			$shortdesc=$_POST['SHORT_DESC'];
			$merchant=$_POST['MERCHANT'];

			$query=$con->prepare("INSERT INTO `item` (`ITEM_NAME`,`STOCK`, `UNITPRICE`, `COSTPRICE`, `SHORT_DESC`,`MERCHANT`) VALUES (?,?,?,?,?,?)");
			$query->bind_param('siddss',$itemname,$stock,$unitprice,$costprice,$shortdesc,$merchant);
            if ($query->execute()){
                echo "Query executed.";
            }else{
                echo "Error executing query.";
            }
	}





}
?>

<body>
    <!--Main Table-->
	<form action="index.php" method="post"> 
	<table>
		<tr><td>itemname: </td><td><input type="text" name="ITEM_NAME"></td></tr>
		<tr><td>stock:     </td><td><input type="text" name="STOCK"></td></tr>
		<tr><td>unitprice: </td><td><input type="text" name="UNITPRICE"></td></tr>
		<tr><td>costprice: </td><td><input type="text" name="COSTPRICE"></td></tr>
		<tr><td>shortdesc: </td><td><input type="text" name="SHORT_DESC"></td></tr>
		<tr><td>merchant: </td><td><input type="text" name="MERCHANT"></td></tr>
		<tr><td></td><td>
	</table>
	<input type="submit" name="Submit" value="Submit"></td></tr>
	</form>

<!-- SELECT query for table -->
<?php
$query="SELECT ITEM_ID, ITEM_NAME, STOCK, UNITPRICE, COSTPRICE, SHORT_DESC, MERCHANT FROM item";
$pQuery = $con->prepare($query);
$result=$pQuery->execute();
$result=$pQuery->get_result();
if(!$result) {
    die("SELECT query failed<br> ".$con->error);    
}
else {
    echo "SELECT query successful<br>";
}
$nrows=$result->num_rows;

// DELETE Function
if (isset($_GET['Submit'])&& $_GET['Submit'] === "Delete"){
$itemID = $_GET['ITEM_ID'];
$query= $con->prepare("DELETE FROM item WHERE ITEM_ID=?");
echo "$itemID";
$query->bind_param('s',$itemID);
if ($query->execute()){
    echo "Query executed.";
    header("location: index.php");
    }
    else{
        echo "Error executing query.";
    }
}

// Table for SELECT function
if ($nrows>0) {
    echo "<table>"; 
	echo "<table align='left' border='1'>";
        echo "<tr>";
            echo "<th>ITEM_ID</th>";
            echo "<th>ITEM_NAME</th>";
            echo "<th>STOCK</th>";
            echo "<th>UNITPRICE</th>";
            echo "<th>COSTPRICE</th>";
            echo "<th>SHORT_DESC</th>";
            echo "<th>MERCHANT</th>";
        echo "</tr>";
        while ($row=$result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>";
            echo $row['ITEM_ID'];
            echo "</td>";
            echo "<td>";
            echo $row['ITEM_NAME'];
            echo "</td>";
            echo "<td>";
            echo $row['STOCK'];
            echo "</td>";
            echo "<td>";
            echo $row['UNITPRICE'];
            echo "</td>";
            echo "<td>";
            echo $row['COSTPRICE'];
            echo "</td>";
            echo "<td>";
            echo $row['SHORT_DESC'];
            echo "</td>";
            echo "<td>";
            echo $row['MERCHANT'];
            echo "</td>";
            echo "<td>";
            echo "<a href='edit3.php?Submit=GetUpdate&ITEM_ID=".$row['ITEM_ID']."'>Edit</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href='index.php?Submit=Delete&ITEM_ID=".$row['ITEM_ID']."'>Delete</a>";
			echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "0 records<br>";
}
?>
</body>
</html>