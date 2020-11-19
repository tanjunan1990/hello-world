<!-- Connection to database -->
<?php
$mysql_host="localhost"; 
$mysql_user="root";
$mysql_password="";
$mysql_db="DB0A170";

$con = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
if (!$con) {
    echo $con->errno . "<br>";
    die('Could not connect: ' . $con->error);
}else{
    echo"Connection success<br>";
}
?>
<!-- select function -->
<?php
$query="SELECT ProductID,ProductName,StockAmount,SellerContact,CreatedDate FROM item37228107";
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
if ($nrows>0) {
    echo "<table>"; 
	echo "<table align='left' border='1'>";
        echo "<tr>";
            echo "<th>Product ID</th>";
            echo "<th>Product Name</th>";
            echo "<th>Stock Amount</th>";
            echo "<th>Seller Contact</th>";
            echo "<th>Created Date</th>";

        echo "</tr>";
        while ($row=$result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>";
            echo $row['ProductID'];
            echo "</td>";
            echo "<td>";
            echo $row['ProductName'];
            echo "</td>";
            echo "<td>";
            echo $row['StockAmount'];
            echo "</td>";
            echo "<td>";
            echo $row['SellerContact'];
            echo "</td>";
            echo "<td>";
            echo $row['CreatedDate'];
            echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "0 records<br>";
}
?>